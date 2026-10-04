<?php

namespace App\Http\Controllers;

use App\Support\Seo;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $today = now()->toDateString();

        $urls = [
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['loc' => route('pages.booking'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => route('stations.show'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => url('/services'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        foreach (array_keys(Seo::stations()) as $id) {
            $urls[] = ['loc' => route('station.show', $id), 'priority' => '0.9', 'changefreq' => 'daily'];
            $urls[] = ['loc' => route('station.products', $id), 'priority' => '0.6', 'changefreq' => 'weekly'];
        }

        $urls[] = ['loc' => route('fuel-orders.create'), 'priority' => '0.7', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => route('lpg-orders.create'), 'priority' => '0.7', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => url('/infoGeneration'), 'priority' => '0.5', 'changefreq' => 'yearly'];
        $urls[] = ['loc' => url('/terms'), 'priority' => '0.2', 'changefreq' => 'yearly'];
        $urls[] = ['loc' => url('/privacy'), 'priority' => '0.2', 'changefreq' => 'yearly'];

        $xml = view('seo.sitemap', compact('urls', 'today'))->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            'Disallow: /login',
            'Disallow: /cancellation',
            'Disallow: /check-availability',
            'Disallow: /get-available-slots',
            'Disallow: /fuel',
            'Disallow: /heating-oil-orders',
            'Allow: /',
            '',
            'Sitemap: ' . url('/sitemap.xml'),
        ];

        return response(implode("\n", $lines) . "\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
