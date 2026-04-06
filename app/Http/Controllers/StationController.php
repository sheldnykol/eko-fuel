<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Log;

class StationController extends Controller
{
    public function show($id){
        $stations = config('stations');

        $station = $stations[$id] ?? null;
        if(!$station) {
            abort(404);
        }
        // Παίρνουμε το slug από το config ή βάζουμε 'larisa' ως default
        $slug = $station['vrisko_slug'] ?? 'larisa';
        $url = "https://www.vrisko.gr/en/fuel-prices/{$slug}/";
       // $scrapedStations = Cache::remember('fuel_prices_drami', 28800, function () {
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
        ])->get($url);
        // Log::info('Vrisko Response Status: ' . $response->status());
        // Log::info('Vrisko HTML Snippet: ' . substr($response->body(), 0, 1000));

        // // Αν θες ΟΛΟ το HTML για να το μελετήσεις:
        // Log::debug("RESPONSE " . $response->body());
        
        if ($response->failed()) {
                $scrapedStations = [];
            } else {
                $crawler = new Crawler($response->body());
                
                // Εδώ ΔΕΝ βάζουμε return μπροστά από το $crawler
                $scrapedStations = $crawler->filter('.gas-result-container')->each(function (Crawler $parent) use ($station) {
                    // Πάρε το όνομα από το Vrisko και αφαίρεσε τα κενά πάνω-κάτω
                    $name = trim($parent->filter('.gas-company-address')->text(''));
                    Log::info("NAME .GAS-COMPPANY-NAME: " . $name);

                    //  Μετέτρεψε ΚΑΙ ΤΑ ΔΥΟ σε απολύτως κεφαλαία και αφαίρεσε τυχόν κενά
                    $searchName = trim(mb_strtoupper($station['name'], 'UTF-8'));
                    $foundName = trim(mb_strtoupper($name, 'UTF-8'));

                    //  Αν ΔΕΝ περιέχει το όνομα (ακριβή διεύθυνση (return null)
                    if (!str_contains($foundName, $searchName)) {
                        return null;
                    }

                    // Αν φτάσαμε εδώ σημαίνει ότι ΒΡΗΚΕ ΤΗ ΔΙΕΥΘΥΝΣΗ! 
                    Log::info("FOUND MATCH FOR: " . $searchName);

                    return [
                        'name' => $name,
                        'address' => trim($parent->filter('.gas-company-address')->text('')),
                        'fuels' => $parent->filter('.gas-price-tag')->each(function (Crawler $fuelNode) {
                            return [
                                'type'  => trim($fuelNode->filter('.gas-product-value')->text('')),
                                'price' => trim($fuelNode->filter('.gas-price-value')->text('')),
                            ];
                        })
                    ];
                });
            }

           
            $scrapedStations = array_filter($scrapedStations);
            Log::info("Station name" . $station['name']);
            // Εδώ γίνεται ο έλεγχος ονόματος: Συγκρίνει το $station['name'] από το config
            // με το $item['name'] από το Vrisko.
            $currentScrapedData = collect($scrapedStations)->first(function($item) use ($station) {
                Log::info("item[name]" . $item['name']);
                return str_contains(mb_strtoupper($item['name'], 'UTF-8'), mb_strtoupper($station['name'], 'UTF-8'));
            });
            Log::info("CurrentScrappedData", (array) $currentScrapedData);
            if ($currentScrapedData) {
                foreach ($currentScrapedData['fuels'] as $fuel) {
                    // ΑΥΤΟ ΕΔΩ ΘΑ ΣΟΥ ΔΕΙΞΕΙ ΤΟ "TYPE" ΣΤΟ LOG
                    Log::info("Fuel type found: '" . $fuel['type'] . "' for station: " . $currentScrapedData['name']);
                }
            }   
       
        $finalPrices = [
            'amolyvdhi_95'   => '-',
            'amolyvdhi_100'  => '-',
            'diesel_economy' => '-',
            'diesel_avio'    => '-',
            'auto_gas'       => '-',
            'petrelaio'      => '-',
        ];

        if ($currentScrapedData) {
            foreach ($currentScrapedData['fuels'] as $fuel) {
                $type = mb_strtolower($fuel['type'], 'UTF-8');
                $price = str_replace(['€', ' '], '', $fuel['price']); 

                if (str_contains($type, '95')) $finalPrices['amolyvdhi_95'] = $price;
                elseif (str_contains($type, 'speed')) $finalPrices['amolyvdhi_100'] = $price;
                elseif (str_contains($type, 'avio')) $finalPrices['diesel_avio'] = $price;
                elseif (str_contains($type, 'diesel')) $finalPrices['diesel_economy'] = $price;
                elseif (str_contains($type, 'auto') || str_contains($type, 'gas')) $finalPrices['auto_gas'] = $price;
                elseif (str_contains($type, 'lt')) $finalPrices['petrelaio'] = $price;
            }
        }

     
        $station['prices'] = $finalPrices;
        Log::info("Station prices" , $station['prices']);

        return view('stations.show', compact("station"));
    }
 
    public function showProducts($id)
    {
    
        $allStations = config('stations');
        $station = $allStations[$id] ?? abort(404);

        $products = Product::where('station_id', $id)->get();

        return view('pages.products', [
            'products' => $products,
            'station' => $station,
            'allStations' => $allStations,
            'id' => $id
        ]);
    }
    public function showStations()
    {
            $allStations = config('stations');
            
            Log::info("station", $allStations);
            $names = array_column($allStations, 'name');
            Log::info("Station Names", $names);
         return view('pages.contact', compact('allStations'));
    }
}
