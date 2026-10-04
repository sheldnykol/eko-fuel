<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Νέα κράτηση</title>
    </head>
    <body style="margin: 0; padding: 20px; background-color: #f8fafc; font-family: Arial, Helvetica, sans-serif">
        <div style="max-width: 560px; margin: 0 auto; background: #ffffff; padding: 28px; border-radius: 12px; border: 1px solid #e2e8f0">
            <h2 style="margin: 0 0 8px; color: #e21838; font-size: 20px">Νέα κράτηση πλυντηρίου</h2>
            <p style="margin: 0 0 20px; color: #334155; font-size: 15px">
                {{ $appointment->customer_name }} · <a href="tel:{{ $appointment->customer_phone }}" style="color: #334155">{{ $appointment->customer_phone }}</a>
                @if ($appointment->customer_email)
                    · {{ $appointment->customer_email }}
                @endif
            </p>

            @include('emails.partials.appointment_details', ['appointment' => $appointment])

            @if ($appointment->comments)
                <p style="margin: 0 0 20px; padding: 10px 12px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; color: #78350f; font-size: 14px">
                    <strong>Σχόλιο πελάτη:</strong> {{ $appointment->comments }}
                </p>
            @endif

            <a
                href="{{ $customLink }}"
                style="display: inline-block; padding: 10px 18px; background: #e21838; border-radius: 8px; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: bold"
            >
                Άνοιγμα στη διαχείριση
            </a>
        </div>
    </body>
</html>
