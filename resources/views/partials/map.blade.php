@php
    use App\Support\Seo;

    $markers = collect(Seo::stations())->map(fn ($station, $id) => [
        'lat' => $station['lat'],
        'lng' => $station['lng'],
        'title' => $station['title'],
        'address' => $station['street'] . ', ' . $station['city'],
        'url' => route('station.show', $id),
        'directions' => Seo::mapsUrl($station),
    ])->values();
@endphp

<section class="bg-white py-14 md:py-20">
    <div class="mx-auto max-w-6xl px-4 md:px-6">
        <div class="mb-6 max-w-2xl">
            <h2 class="text-2xl font-black tracking-tight text-slate-900 md:text-3xl">Βρείτε μας στον χάρτη</h2>
            <p class="mt-2 text-sm text-slate-600 md:text-base">Οδηγίες πλοήγησης προς το πλησιέστερο πρατήριο ΕΚΟ Δράμη.</p>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200">
            <div id="map" class="h-[380px] w-full md:h-[440px]"></div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>
    <script src="https://unpkg.com/maplibre-gl@4.7.1/dist/maplibre-gl.js" defer></script>
    <script src="https://unpkg.com/@maplibre/maplibre-gl-leaflet@0.0.22/leaflet-maplibre-gl.js" defer></script>

    <script>
        window.addEventListener('load', function () {
            if (!window.L) return
            const stations = @json($markers);
            const map = L.map('map', { scrollWheelZoom: false }).setView([39.639, 22.431], 13)

            L.maplibreGL({
                style: 'https://tiles.openfreemap.org/styles/positron',
                attribution: '<a href="https://openfreemap.org" target="_blank" rel="noopener">OpenFreeMap</a> © <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>',
            }).addTo(map)

            const icon = L.icon({
                iconUrl: @json(asset('images/opt/pineza-eko-112.png')),
                iconSize: [48, 48],
                iconAnchor: [24, 48],
                popupAnchor: [0, -46],
            })

            const escape = text => String(text).replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[c])

            stations.forEach(s => {
                L.marker([s.lat, s.lng], { icon, title: s.title })
                    .addTo(map)
                    .bindPopup(
                        `<strong>${escape(s.title)}</strong><br><span style="color:#64748b">${escape(s.address)}</span><br>` +
                            `<a href="${s.url}">Τιμές & υπηρεσίες</a> · <a href="${s.directions}" target="_blank" rel="noopener">Οδηγίες</a>`
                    )
            })
        })
    </script>

    <style>
        .leaflet-container {
            font-family: inherit;
        }
        #map {
            z-index: 1;
        }
    </style>
</section>
