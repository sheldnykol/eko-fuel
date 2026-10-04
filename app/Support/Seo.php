<?php

namespace App\Support;

class Seo
{
    public const SITE_NAME = 'ΕΚΟ Δράμη';

    public const LEGAL_NAME = 'ΕΚΟ ΑΦΟΙ ΔΡΑΜΗ';

    public const PHONE = '2410283954';

    public static function stations(): array
    {
        return config('stations', []);
    }

    public static function station(int|string $id): ?array
    {
        return self::stations()[$id] ?? null;
    }

    public static function phoneE164(string $phone): string
    {
        return '+30' . preg_replace('/\D/', '', $phone);
    }

    public static function image(string $file): string
    {
        $optimized = 'images/opt/' . pathinfo($file, PATHINFO_FILENAME) . '.webp';

        return asset(file_exists(public_path($optimized)) ? $optimized : 'images/' . $file);
    }

    public static function mapsUrl(array $station): string
    {
        return 'https://www.google.com/maps/dir/?api=1&destination=' . $station['lat'] . ',' . $station['lng'];
    }

    public static function organization(): array
    {
        return [
            '@type' => 'Organization',
            '@id' => url('/') . '#organization',
            'name' => self::SITE_NAME,
            'legalName' => self::LEGAL_NAME,
            'url' => url('/'),
            'logo' => asset('images/opt/eko-logo-512.png'),
            'telephone' => self::phoneE164(self::PHONE),
            'areaServed' => ['Λάρισα', 'Θεσσαλία', 'Μαγνησία'],
        ];
    }

    public static function website(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'url' => url('/'),
            'name' => self::SITE_NAME,
            'inLanguage' => 'el-GR',
            'publisher' => ['@id' => url('/') . '#organization'],
        ];
    }

    public static function stationSchema(int|string $id): array
    {
        $station = self::station($id);

        $address = array_filter([
            '@type' => 'PostalAddress',
            'streetAddress' => $station['street'],
            'addressLocality' => $station['city'],
            'addressRegion' => $station['region'],
            'postalCode' => $station['postal_code'] ?? null,
            'addressCountry' => 'GR',
        ]);

        $schema = [
            '@type' => $station['has_wash'] ? ['GasStation', 'AutoWash'] : 'GasStation',
            '@id' => route('station.show', $id) . '#station',
            'name' => $station['title'] . ' - ' . $station['city'],
            'description' => $station['description'],
            'url' => route('station.show', $id),
            'image' => self::image($station['image']),
            'telephone' => self::phoneE164($station['phone']),
            'brand' => ['@type' => 'Brand', 'name' => 'EKO'],
            'parentOrganization' => ['@id' => url('/') . '#organization'],
            'address' => $address,
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $station['lat'],
                'longitude' => $station['lng'],
            ],
            'hasMap' => self::mapsUrl($station),
            'openingHoursSpecification' => [[
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opens' => $station['opens'],
                'closes' => $station['closes'],
            ]],
            'priceRange' => '€',
        ];

        if ($station['has_wash']) {
            $schema['potentialAction'] = [
                '@type' => 'ReserveAction',
                'target' => route('pages.booking'),
                'name' => 'Online ραντεβού για πλυντήριο αυτοκινήτου',
            ];
        }

        return $schema;
    }

    public static function breadcrumbs(array $items): array
    {
        $list = [];
        foreach (array_values($items) as $index => [$name, $url]) {
            $list[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $name,
                'item' => $url,
            ];
        }

        return ['@type' => 'BreadcrumbList', 'itemListElement' => $list];
    }

    public static function faq(array $questions): array
    {
        return [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn ($answer, $question) => [
                '@type' => 'Question',
                'name' => $question,
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $answer],
            ], $questions, array_keys($questions)),
        ];
    }

    public static function graph(array ...$nodes): string
    {
        return json_encode(
            ['@context' => 'https://schema.org', '@graph' => array_values($nodes)],
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG
        );
    }
}
