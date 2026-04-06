<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="UTF-8" />
        <title>Τιμές Αμόλυβδης 95</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 p-10">
        <div class="container mt-5">
            <div class="row">
                @foreach ($gasStations as $station)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $station['name'] }}</h5>
                                <p class="card-text text-muted small">{{ $station['address'] }}</p>

                                <hr />

                                <h6>Τιμές Καυσίμων:</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($station['fuels'] as $fuel)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $fuel['type'] }}

                                            @if ($fuel['price'] !== '-')
                                                <span class="badge bg-success rounded-pill">{{ $fuel['price'] }}</span>
                                            @else
                                                <span class="badge bg-secondary rounded-pill">N/A</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="mt-3 text-end">
                                    <small class="text-muted">Ενημέρωση: {{ $station['last_update'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
