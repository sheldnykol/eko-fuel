<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class FuelPriceScraper
{
    private const CACHE_SECONDS = 14400;

    private const EMPTY_CACHE_SECONDS = 1800;

    private const EMPTY = [
        'amolyvdhi_95' => '-',
        'amolyvdhi_100' => '-',
        'diesel_economy' => '-',
        'diesel_avio' => '-',
        'auto_gas' => '-',
        'petrelaio' => '-',
    ];

    private array $pages = [];

    public function cached(int|string $id): array
    {
        return Cache::get($this->cacheKey($id)) ?? $this->refresh($id);
    }

    public function refresh(int|string $id): array
    {
        $station = config("stations.$id");
        $prices = $station ? $this->scrape($station) : self::EMPTY;
        $found = collect($prices)->contains(fn ($price) => $price !== '-');

        if ($found || ! Cache::has($this->cacheKey($id))) {
            Cache::put($this->cacheKey($id), $prices, $found ? self::CACHE_SECONDS : self::EMPTY_CACHE_SECONDS);
        }

        return $found ? $prices : (Cache::get($this->cacheKey($id)) ?? $prices);
    }

    private function cacheKey(int|string $id): string
    {
        return "station-prices:$id";
    }

    private function scrape(array $station): array
    {
        $html = $this->page($station['vrisko_slug'] ?? 'larisa');
        if ($html === null) {
            return self::EMPTY;
        }

        $searchName = trim(mb_strtoupper($station['name'], 'UTF-8'));

        $match = collect((new Crawler($html))->filter('.gas-result-container')->each(fn (Crawler $node) => [
            'name' => trim($node->filter('.gas-company-address')->text('')),
            'fuels' => $node->filter('.gas-price-tag')->each(fn (Crawler $fuel) => [
                'type' => trim($fuel->filter('.gas-product-value')->text('')),
                'price' => trim($fuel->filter('.gas-price-value')->text('')),
            ]),
        ]))->first(fn (array $item) => str_contains(trim(mb_strtoupper($item['name'], 'UTF-8')), $searchName));

        $prices = self::EMPTY;
        if (! $match) {
            return $prices;
        }

        foreach ($match['fuels'] as $fuel) {
            $type = mb_strtolower($fuel['type'], 'UTF-8');
            $price = str_replace(['€', ' '], '', $fuel['price']);

            if (str_contains($type, '95')) {
                $prices['amolyvdhi_95'] = $price;
            } elseif (str_contains($type, 'speed')) {
                $prices['amolyvdhi_100'] = $price;
            } elseif (str_contains($type, 'avio')) {
                $prices['diesel_avio'] = $price;
            } elseif (str_contains($type, 'diesel')) {
                $prices['diesel_economy'] = $price;
            } elseif (str_contains($type, 'auto') || str_contains($type, 'gas')) {
                $prices['auto_gas'] = $price;
            } elseif (str_contains($type, 'lt')) {
                $prices['petrelaio'] = $price;
            }
        }

        return $prices;
    }

    private function page(string $slug): ?string
    {
        if (array_key_exists($slug, $this->pages)) {
            return $this->pages[$slug];
        }

        $url = "https://www.vrisko.gr/en/fuel-prices/$slug/";
        $key = config('services.scraperapi.key');

        try {
            $response = $key
                ? Http::timeout(70)->get('https://api.scraperapi.com/', ['api_key' => $key, 'url' => $url])
                : Http::timeout(10)->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                    'Accept-Language' => 'el-GR,el;q=0.9,en-US;q=0.8,en;q=0.7',
                    'Accept-Encoding' => 'gzip, deflate, br',
                    'Upgrade-Insecure-Requests' => '1',
                    'Sec-Fetch-Dest' => 'document',
                    'Sec-Fetch-Mode' => 'navigate',
                    'Sec-Fetch-Site' => 'none',
                    'Sec-Fetch-User' => '?1',
                    'Cache-Control' => 'max-age=0',
                ])->get($url);
        } catch (\Throwable $e) {
            Log::warning('Αποτυχία λήψης τιμών καυσίμων (' . $slug . '): ' . $e->getMessage());

            return $this->pages[$slug] = null;
        }

        if ($response->failed()) {
            Log::warning('Αποτυχία λήψης τιμών καυσίμων (' . $slug . '): HTTP ' . $response->status());

            return $this->pages[$slug] = null;
        }

        return $this->pages[$slug] = $response->body();
    }
}
