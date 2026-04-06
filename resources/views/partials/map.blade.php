<section class="bg-slate-50 py-16 md:py-24">
    {{-- Schema.org - Χρησιμοποιούμε διπλό @@ για να μην το εκλάβει το Blade ως directive --}}
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "AutoWash",
            "name": "ΕΚΟ ΑΦΟΙ Κ. ΔΡΑΜΗ",
            "image": "{{ asset('images/eko-logo.png') }}",
            "address": {
                "@@type": "PostalAddress",
                "streetAddress": "Βόλου 12",
                "addressLocality": "Λάρισα",
                "postalCode": "41336",
                "addressCountry": "GR"
            },
            "geo": {
                "@@type": "GeoCoordinates",
                "latitude": 39.6343,
                "longitude": 22.43025
            },
            "url": "{{ url('/') }}",
            "telephone": "+302410XXXXXX",
            "priceRange": "$$"
        }
    </script>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col items-center justify-center text-center">
            <div
                class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-md ring-1 ring-slate-100"
            >
                <img class="h-10 w-10 object-contain" src="{{ asset('images/map.png') }}" alt="Εικονίδιο Χάρτη EKO" />
            </div>
            <h2 class="text-3xl font-black tracking-tight text-slate-900 md:text-5xl">Χάρτης Πρατηρίων EKO</h2>
            <p class="mt-4 text-lg text-slate-500">Εντοπίστε μας στη Θεσσαλία και λάβετε οδηγίες πλοήγησης</p>
        </div>

        <div class="relative overflow-hidden rounded-[2.5rem] bg-white p-3 shadow-2xl ring-1 ring-slate-200">
            <div id="map" class="z-10 h-[500px] w-full rounded-[2rem]"></div>
        </div>
    </div>

    {{-- Leaflet Assets --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stations = [
                {
                    lat: 39.6343,
                    lng: 22.43025,
                    name: '<div class="p-2"><b style="color:#e21838; font-size:16px;">ΕΚΟ ΑΦΟΙ Κ. ΔΡΑΜΗ</b><br><span style="color:#666;">ΒΟΛΟΥ 12, ΛΑΡΙΣΑ</span><br><a href="https://www.google.com/maps/dir/?api=1&destination=39.6343,22.43025" target="_blank" style="display:inline-block; margin-top:10px; color:#fff; background:#e21838; padding:5px 10px; border-radius:5px; text-decoration:none; font-size:12px;">Οδηγίες Χάρτη</a></div>',
                },
                {
                    lat: 39.62728,
                    lng: 22.43262,
                    name: '<div class="p-2"><b style="color:#e21838; font-size:16px;">ΕΚΟ ΑΦΟΙ Κ. ΔΡΑΜΗ</b><br><span style="color:#666;">1ο ΧΛΜ Π.Ε.Ο ΛΑΡΙΣΑΣ-ΑΘΗΝΩΝ</span><br><a href="https://www.google.com/maps/dir/?api=1&destination=39.62728,22.43262" target="_blank" style="display:inline-block; margin-top:10px; color:#fff; background:#e21838; padding:5px 10px; border-radius:5px; text-decoration:none; font-size:12px;">Οδηγίες Χάρτη</a></div>',
                },
                {
                    lat: 39.642757,
                    lng: 22.420073,
                    name: '<div class="p-2"><b style="color:#e21838; font-size:16px;">ΕΚΟ ΑΦΟΙ A. ΔΡΑΜΗ</b><br><span style="color:#666;">ΓΕΩΡΓΙΑΔΟΥ 28, ΛΑΡΙΣΑ</span><br><a href="https://www.google.com/maps/dir/?api=1&destination=39.642757,22.420073" target="_blank" style="display:inline-block; margin-top:10px; color:#fff; background:#e21838; padding:5px 10px; border-radius:5px; text-decoration:none; font-size:12px;">Οδηγίες Χάρτη</a></div>',
                },
                {
                    lat: 39.384301,
                    lng: 22.994214,
                    name: '<div class="p-2"><b style="color:#e21838; font-size:16px;">ΕΚΟ ΑΦΟΙ Κ. ΔΡΑΜΗ</b><br><span style="color:#666;">11ο ΧΛΜ, ΕΟ ΒΟΛΟΥ ΠΟΡΤΑΡΙΑΣ</span><br><a href="https://www.google.com/maps/dir/?api=1&destination=39.384301,22.994214" target="_blank" style="display:inline-block; margin-top:10px; color:#fff; background:#e21838; padding:5px 10px; border-radius:5px; text-decoration:none; font-size:12px;">Οδηγίες Χάρτη</a></div>',
                },
            ]

            const map = L.map('map', {
                scrollWheelZoom: false,
            }).setView([39.639, 22.431], 13)

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap contributors',
            }).addTo(map)

            const redIcon = L.icon({
                iconUrl: '{{ asset('images/pineza-eko.png') }}',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                iconSize: [70, 70],
                iconAnchor: [35, 70],
                popupAnchor: [0, -70],
            })

            stations.forEach(station => {
                L.marker([station.lat, station.lng], { icon: redIcon }).addTo(map).bindPopup(station.name)
            })
        })
    </script>

    <style>
        .leaflet-popup-content-wrapper {
            border-radius: 12px;
            padding: 5px;
        }
        .leaflet-container {
            font-family: inherit;
        }
        #map {
            z-index: 1;
        }
    </style>
</section>
