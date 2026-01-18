<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class FuelPricesController extends Controller
{
    public function getPrices()
    {
        // Cache για 1 ώρα – μην καλείς συνέχεια το API
        return Cache::remember('fuel_prices', 3600, function () {
            // Εδώ βάλε την πραγματική κλήση στο δικό σου API (όπως είπες στην αρχή ότι το έχετε)
            // Παράδειγμα – άλλαξε το URL και τα keys με τα δικά σου
            $response = \Illuminate\Support\Facades\Http::get('https://your-api.example.com/prices?station=larisa-volou12');

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'amolyvdhi_100'     => $data['fuels']['100'] ?? 'N/A',
                    'amolyvdhi_95'      => $data['fuels']['95']  ?? 'N/A',
                    'diesel_economy'    => $data['fuels']['diesel_economy'] ?? 'N/A',
                    'diesel_avio'       => $data['fuels']['diesel_avio'] ?? 'N/A',
                    'auto_gas'          => $data['fuels']['autogas'] ?? 'N/A',
                    'petrelaio'         => $data['fuels']['heating'] ?? 'N/A',
                    'updated_at'        => $data['updated_at'] ?? now()->format('d/m/Y H:i'),
                ];
            }

            // Αν πέσει το API → fallback τιμές
            return [
                'amolyvdhi_100'     => '1.98 €',
                'amolyvdhi_95'      => '1.78 €',
                'diesel_economy'    => '1.78 €',
                'diesel_avio'       => '1.98 €',
                'auto_gas'          => '0.999 €',
                'petrelaio'         => '1.130 €',
                'updated_at'        => now()->format('d/m/Y H:i') . ' (fallback)',
            ];
        });
    }
}