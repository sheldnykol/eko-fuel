<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class FuelPricesController extends Controller
{
    public function getPrices()
    {
        // Cache για 1 ώρα (3600 δευτ.) – μην καλείς συνέχεια το fuelgr.gr
        return Cache::remember('fuel_prices_kinitron', 3600, function () {
            try {
                // Το URL του πρατηρίου σου (ID=159 από την έρευνα)
                $url = 'https://fuelgr.gr/web/station/159';

                $response = Http::get($url);

                if (!$response->successful()) {
                    return $this->fallbackPrices();
                }

                $html = $response->body();
                $crawler = new Crawler($html);

                $prices = [];

                // Βρίσκουμε όλα τα καύσιμα από τον πίνακα
                $crawler->filter('.station-prices-table tr')->each(function (Crawler $row) use (&$prices) {
                    $fuel = trim($row->filter('td:first-child')->text('') ?? '');
                    $price = trim($row->filter('td:last-child')->text('') ?? '');

                    if ($fuel && $price && str_contains($price, '€')) {
                        $key = $this->getFuelKey($fuel);
                        if ($key) {
                            $prices[$key] = $price;
                        }
                    }
                });

                $prices['updated_at'] = now()->format('d/m/Y H:i');

                return $prices;
            } catch (\Exception $e) {
                // Αν κάτι πάει στραβά, log και fallback
                \Log::error('Fuel scraping failed: ' . $e->getMessage());
                return $this->fallbackPrices();
            }
        });
    }

    private function getFuelKey($name)
    {
        $name = mb_strtolower(trim($name));

        return match (true) {
            str_contains($name, 'αμόλυβδη 100') || str_contains($name, 'kinitron 100') => 'amolyvdhi_100',
            str_contains($name, 'αμόλυβδη 95') || str_contains($name, 'unleaded 95') => 'amolyvdhi_95',
            str_contains($name, 'diesel economy') || str_contains($name, 'ekonomy') => 'diesel_economy',
            str_contains($name, 'diesel avio') => 'diesel_avio',
            str_contains($name, 'auto gas') || str_contains($name, 'υγραέριο') => 'auto_gas',
            str_contains($name, 'θέρμανσης') => 'petrelaio',
            default => null,
        };
    }

    private function fallbackPrices()
    {
        return [
            'amolyvdhi_100'     => '1.58 €',
            'amolyvdhi_95'      => '1.48 €',
            'diesel_economy'    => '1.78 €',
            'diesel_avio'       => '1.98 €',
            'auto_gas'          => '0.999 €',
            'petrelaio'         => '1.130 €',
            'updated_at'        => now()->format('d/m/Y H:i') . ' (fallback)',
        ];
    }
}