<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class FuelPricesController extends Controller
{
    public function getVriskoPrices()
    {
        $gasStations = Cache::remember('fuel_prices_drami', 28800, function () {
            try {
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
                    'Accept-Language' => 'el-GR,el;q=0.9,en-US;q=0.8,en;q=0.7',
                    'Referer' => 'https://www.google.gr/',
                    'Connection' => 'keep-alive',
                    'Upgrade-Insecure-Requests' => '1',
                    'Sec-Fetch-Dest' => 'document',
                    'Sec-Fetch-Mode' => 'navigate',
                    'Sec-Fetch-Site' => 'cross-site',
                    'Cache-Control' => 'max-age=0',
                ])->get('https://www.vrisko.gr/en/fuel-prices/larisa/');

                if (!$response->successful()) {
                    Log::error('Vrisko Scraping Failed: HTTP ' . $response->status());
                    return [];
                }

                $crawler = new Crawler($response->body());

                $data = $crawler->filter('.gas-result-container')->each(function (Crawler $parent) {
                    $nameNode = $parent->filter('.gas-company-name');
                    if (!$nameNode->count()) return null;
                    
                    $name = $nameNode->text('');

                    if (!str_contains(mb_strtoupper($name, 'UTF-8'), 'ΔΡΑΜΗ')) {
                        return null;
                    }

                    $fuels = $parent->filter('.gas-price-tag')->each(function (Crawler $fuelNode) {
                        $fuelName = trim($fuelNode->filter('.gas-product-value')->text(''));
                        $fuelPrice = trim($fuelNode->filter('.gas-price-value')->text(''));

                        return [
                            'type'  => $fuelName,
                            'price' => ($fuelPrice === '-' || empty($fuelPrice)) ? 'N/A' : $fuelPrice,
                        ];
                    });

                    return [
                        'name'        => trim($name),
                        'address'     => trim($parent->filter('.gas-company-address')->text('')),
                        'brand_class' => $parent->filter('.gas-logo span')->count() ? $parent->filter('.gas-logo span')->attr('class') : '',
                        'last_update' => $parent->filter('.last-update-date')->count() ? trim($parent->filter('.last-update-date')->text('')) : '',
                        'fuels'       => $fuels
                    ];
                });

                return array_values(array_filter($data));
            } catch (\Exception $e) {
                Log::error('Σφάλμα στο Vrisko Scraping: ' . $e->getMessage());
                return [];
            }
        });

        return view('fuel-prices', compact('gasStations'));
    }
}