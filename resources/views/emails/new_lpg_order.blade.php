<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8fafc;
                padding: 20px;
            }
            .container {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 10px;
                max-width: 600px;
                margin: 0 auto;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            }
            h2 {
                color: #e21838;
                border-bottom: 2px solid #f1f5f9;
                padding-bottom: 10px;
            }
            ul {
                list-style-type: none;
                padding: 0;
            }
            li {
                margin-bottom: 10px;
                font-size: 16px;
                color: #334155;
            }
            strong {
                color: #0f172a;
            }
            .footer {
                margin-top: 30px;
                font-size: 12px;
                color: #94a3b8;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Νέα Παραγγελία Υγραερίου (LPG)</h2>
            <p>Έχετε μια νέα παραγγελία μέσω του συστήματος. Ακολουθούν τα στοιχεία του πελάτη:</p>

            <ul>
                <li>
                    <strong>Ονοματεπώνυμο:</strong>
                    {{ $order->lpg_name }}
                </li>
                <li>
                    <strong>Τηλέφωνο:</strong>
                    {{ $order->lpg_phone }}
                </li>
                <li>
                    <strong>ΑΦΜ:</strong>
                    {{ $order->lpg_afm }}
                </li>
                <li>
                    <strong>Πόλη:</strong>
                    {{ $order->lpg_city }}
                </li>
                <li>
                    <strong>Διεύθυνση:</strong>
                    {{ $order->lpg_address }} {{ $order->lpg_number_address }}
                </li>
                <li>
                    <strong>Τύπος Υγραερίου:</strong>
                    {{ $order->lpg_type }}
                </li>
                <li>
                    <strong>Ποσότητα:</strong>
                    {{ $order->lpg_quantity }} Λίτρα
                </li>
            </ul>

            <div class="footer">Αυτό το email στάλθηκε αυτόματα από το σύστημα κρατήσεων EKO.</div>
        </div>
    </body>
</html>
