
    <section class="bg-white py-12">
        <div class="container mx-auto px-4">
        <h2 class=" text-center text-2xl font-extrabold md:text-3xl mb-2" >Χάρτης Πρατηρίων</h2>

<div id="map" style='height: 500px; width:125%'></div>

<!-- Leaflet JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

    // Συντεταγμένες Πρατηρίων
    const stations=[
        {lat:39.63430, lng:22.43025, name:'<a href="https://www.google.com/maps/place/EKO/@39.6344437,22.4300124,19.67z/data=!4m14!1m7!3m6!1s0x1358861e8c3b5487:0x4e4dbb4cb8f45281!2sEKO!8m2!3d39.6272381!4d22.4326354!16s%2Fg%2F11g6ny10t0!3m5!1s0x135886208a2a3909:0x860f785d3ab07c93!8m2!3d39.6342663!4d22.430354!16s%2Fg%2F11bvvx32tp?entry=ttu&g_ep=EgoyMDI2MDExMy4wIKXMDSoASAFQAw%3D%3D" ' +
                          'target="_blank" rel="noopener noreferrer" style="color:#1a73e8; text-decoration:none; font-weight:bold;">' +
                          'ΕΚΟ ΑΦΟΙ Κ. ΔΡΑΜΗ<br>ΒΟΛΟΥ 12, ΛΑΡΙΣΑ</a>'},
        {lat:39.62728,lng:22.43262, name:'<a href="https://www.google.com/maps/place/EKO/@39.6272381,22.4326354,18z/data=!3m1!4b1!4m6!3m5!1s0x1358861e8c3b5487:0x4e4dbb4cb8f45281!8m2!3d39.6272381!4d22.4326354!16s%2Fg%2F11g6ny10t0?entry=ttu&g_ep=EgoyMDI2MDExMy4wIKXMDSoASAFQAw%3D%3D" ' +
                          'target="_blank" rel="noopener noreferrer" style="color:#1a73e8; text-decoration:none; font-weight:bold;">' +
                          'ΕΚΟ ΑΦΟΙ Κ. ΔΡΑΜΗ<br>1ο ΧΛΜ Π.Ε.Ο ΛΑΡΙΣΑΣ-ΑΘΗΝΩΝ Κ. ΚΑΡΑΜΑΝΛΗ 102</a'}
    ];

    // Δημιουργία χάρτη
    const map = L.map('map').setView([stations[0].lat, stations[0].lng], 12);

    // Φόρτωση χαρτών OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    const redIcon = L.icon({
        iconUrl: "{{ asset('images/pineza-eko.png')}}",
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize:[70,70]
    
    });
    // Marker
    stations.forEach(station => {
        L.marker([station.lat,station.lng],  { icon: redIcon })
        .addTo(map)
        .bindPopup(station.name)
        .openPopup
    });

    
</script>
</section>

