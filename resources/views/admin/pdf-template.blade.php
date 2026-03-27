<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <style>
            body {
                font-family: 'DejaVu Sans', sans-serif;
                color: #333;
            }
            .header {
                text-align: center;
                border-bottom: 2px solid #e21838;
                padding-bottom: 20px;
                margin-bottom: 30px;
            }
            .logo {
                color: #e21838;
                font-size: 28px;
                font-weight: bold;
            }
            .title {
                font-size: 18px;
                color: #666;
                margin-top: 10px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th {
                background-color: #f8f9fa;
                color: #e21838;
                text-transform: uppercase;
                font-size: 12px;
                padding: 12px;
                border-bottom: 1px solid #ddd;
            }
            td {
                padding: 12px;
                border-bottom: 1px solid #eee;
                font-size: 13px;
            }
            .plate {
                background-color: #000;
                color: #fff;
                padding: 4px 8px;
                border-radius: 4px;
                font-family: monospace;
            }
            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                font-size: 10px;
                color: #999;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="logo">EKO FUEL - WASH</div>
            <div class="title">Πρόγραμμα Ραντεβού: {{ date('d/m/Y', strtotime($date)) }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Ώρα</th>
                    <th>Πελάτης</th>
                    <th>Τηλέφωνο</th>
                    <th>Πινακίδα</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $app)
                    <tr>
                        <td><strong>{{ date('H:i', strtotime($app->appointment_time)) }}</strong></td>
                        <td>{{ $app->customer_name }}</td>
                        <td>{{ $app->customer_phone }}</td>
                        <td><span class="plate">{{ $app->license_plate }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">Εκτύπωση από το σύστημα διαχείρισης EKO Fuel - {{ date('d/m/Y H:i') }}</div>
    </body>
</html>
