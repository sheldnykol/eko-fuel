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
    return Cache::remember('fuel_prices_kinitron', 3600, function () {
        try {
            $stationId = 159;
            $url = "https://fuelgr.gr/api/station/{$stationId}";

            $response = Http::get($url);

            if (!$response->successful()) {
                return $this->fallbackPrices();
            }

            $data = $response->json();

            // Η δομή αλλάζει, αλλά συνήθως είναι κάπως έτσι
            $prices = [];

            if (isset($data['fuels'])) {
                foreach ($data['fuels'] as $fuel) {
                    $key = $this->getFuelKey($fuel['name'] ?? '');
                    if ($key) {
                        $prices[$key] = $fuel['price'] . ' €';
                    }
                }
            }

            $prices['updated_at'] = $data['updated_at'] ?? now()->format('d/m/Y H:i');

            return $prices;
        } catch (\Exception $e) {
            \Log::error('Fuel API error: ' . $e->getMessage());
            return $this->fallbackPrices();
        }
    });
}
}