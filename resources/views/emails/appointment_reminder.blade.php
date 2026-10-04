<!DOCTYPE html>
<html lang="el">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Υπενθύμιση ραντεβού</title>
    </head>
    <body style="margin: 0; padding: 20px; background-color: #f8fafc; font-family: Arial, Helvetica, sans-serif">
        <div style="max-width: 560px; margin: 0 auto; background: #ffffff; padding: 28px; border-radius: 12px; border: 1px solid #e2e8f0">
            <h2 style="margin: 0 0 8px; color: #e21838; font-size: 20px">Υπενθύμιση: το ραντεβού σας είναι αύριο</h2>
            <p style="margin: 0 0 20px; color: #334155; font-size: 15px">
                Γεια σας {{ $appointment->customer_name }}, σας υπενθυμίζουμε το ραντεβού σας στο πλυντήριο:
            </p>

            @include('emails.partials.appointment_details', ['appointment' => $appointment])

            <p style="margin: 0 0 16px; color: #64748b; font-size: 13px">
                Αν δεν μπορείτε να έρθετε, παρακαλούμε ακυρώστε το ραντεβού για να εξυπηρετηθεί άλλος πελάτης.
            </p>
            <a
                href="{{ $appointment->cancelUrl() }}"
                style="display: inline-block; padding: 10px 18px; border: 1px solid #cbd5e1; border-radius: 8px; color: #334155; text-decoration: none; font-size: 14px"
            >
                Ακύρωση ραντεβού
            </a>

            <p style="margin: 28px 0 0; padding-top: 16px; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 12px">
                ΕΚΟ Δράμη · Βόλου 12, Λάρισα · 2410 283954
            </p>
        </div>
    </body>
</html>
