<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Log;

    // public function getVriskoPrices()
    // {
    //     $response = Http::withHeaders([
    //         'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
    //         'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
    //         'Accept-Language' => 'el-GR,el;q=0.9,en-US;q=0.8,en;q=0.7',
    //         'Accept-Encoding' => 'gzip, deflate, br',
    //         'Upgrade-Insecure-Requests' => '1',
    //         'Sec-Fetch-Dest' => 'document',
    //         'Sec-Fetch-Mode' => 'navigate',
    //         'Sec-Fetch-Site' => 'none',
    //         'Sec-Fetch-User' => '?1',
    //         'Cache-Control' => 'max-age=0',
    //     ])->get('https://www.vrisko.gr/en/fuel-prices/larisa/');
    //     Log::info('Vrisko Response Status: ' . $response->status());
    //     Log::info('Vrisko HTML Snippet: ' . substr($response->body(), 0, 1000));

    //     // Αν θες ΟΛΟ το HTML για να το μελετήσεις:
    //     Log::debug($response->body());

    //     $crawler = new Crawler($response->body());

    //         $gasStations = $crawler->filter('.gas-result-container')->each(function (Crawler $parent) {
                
    //             // 1. Στοιχεία Πρατηρίου
    //             $name = $parent->filter('.gas-company-name')->text('');
    //             $address = $parent->filter('.gas-company-address')->text('');
    //             $lastUpdate = $parent->filter('.last-update-date')->text('');
                
    //             // 2. Λογότυπο (παίρνουμε το class της μάρκας π.χ. gas_SHELL)
    //             $brandClass = $parent->filter('.gas-logo span')->attr('class');

    //             // 3. Loop σε όλα τα καύσιμα του συγκεκριμένου πρατηρίου
    //             $fuels = $parent->filter('.gas-price-tag')->each(function (Crawler $fuelNode) {
    //                 return [
    //                     'type'  => trim($fuelNode->filter('.gas-product-value')->text('')),
    //                     'price' => trim($fuelNode->filter('.gas-price-value')->text('')),
    //                 ];
    //             });

    //             return [
    //                 'name' => $name,
    //                 'address' => $address,
    //                 'brand' => $brandClass,
    //                 'last_update' => $lastUpdate,
    //                 'fuels' => $fuels // Πίνακας με όλα τα καύσιμα
    //             ];
    //         });

    //         return view('fuel-prices', compact('gasStations'));
    //     }

class FuelPricesController extends Controller
    {
    public function getVriskoPrices()
    {
    $gasStations = Cache::remember('fuel_prices_drami', 28800, function () {
        $response = Http::withHeaders([
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
        ])->get('https://www.vrisko.gr/en/fuel-prices/larisa/');
        Log::info('Vrisko Response Status: ' . $response->status());
        Log::info('Vrisko HTML Snippet: ' . substr($response->body(), 0, 1000));

        // Αν θες ΟΛΟ το HTML για να το μελετήσεις:
        Log::debug($response->body());

        $crawler = new Crawler($response->body());



            // 2. Scraping και Φιλτράρισμα
            $data = $crawler->filter('.gas-result-container')->each(function (Crawler $parent) {
                
                $name = $parent->filter('.gas-company-name')->text('');

                // Φιλτράρουμε μόνο τα πρατήρια που περιέχουν "ΔΡΑΜΗ" στο όνομα
                // Χρησιμοποιούμε mb_strtoupper για να μην έχουμε θέμα με κεφαλαία/μικρά
                if (!str_contains(mb_strtoupper($name, 'UTF-8'), 'ΔΡΑΜΗ')) {
                    return null;
                }

                // Παίρνουμε όλα τα είδη καυσίμων για το συγκεκριμένο πρατήριο
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
                    'brand_class' => $parent->filter('.gas-logo span')->attr('class'),
                    'last_update' => trim($parent->filter('.last-update-date')->text('')),
                    'fuels'       => $fuels
                ];
            });

            // Αφαιρούμε τα null στοιχεία (τα πρατήρια που δεν ήταν "ΔΡΑΜΗ")
            return array_filter($data);
        });

        // 3. Επιστροφή στο Blade
        return view('fuel-prices', compact('gasStations'));
    }
    

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