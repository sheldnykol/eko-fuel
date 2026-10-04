<?php

use App\Mail\AppointmentReminder;
use App\Models\Appointment;
use App\Models\User;
use App\Support\FuelPriceScraper;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Validator;

Artisan::command('users:create', function () {
    $name = $this->ask('Όνομα');
    $email = $this->ask('Email');
    $role = $this->choice('Ρόλος (admin: βλέπει τα πάντα, staff: μόνο ραντεβού και σημειώσεις)', User::ROLES, 1);
    $password = $this->secret('Κωδικός (τουλάχιστον 8 χαρακτήρες)');

    $validator = Validator::make(compact('name', 'email', 'password'), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }

        return 1;
    }

    User::create(compact('name', 'email', 'password', 'role'));
    $this->info("Ο χρήστης {$email} δημιουργήθηκε με ρόλο {$role}.");
})->purpose('Δημιουργία λογαριασμού διαχείρισης');

Artisan::command('users:role {email} {role}', function (string $email, string $role) {
    if (! in_array($role, User::ROLES, true)) {
        $this->error('Ο ρόλος πρέπει να είναι admin ή staff.');

        return 1;
    }

    $user = User::where('email', $email)->first();
    if (! $user) {
        $this->error("Δεν βρέθηκε χρήστης με email {$email}.");

        return 1;
    }

    $user->update(['role' => $role]);
    $this->info("Ο χρήστης {$email} έχει πλέον ρόλο {$role}.");
})->purpose('Αλλαγή ρόλου λογαριασμού διαχείρισης');

Artisan::command('users:password {email}', function (string $email) {
    $user = User::where('email', $email)->first();
    if (! $user) {
        $this->error("Δεν βρέθηκε χρήστης με email {$email}.");

        return 1;
    }

    $password = $this->secret('Νέος κωδικός (τουλάχιστον 8 χαρακτήρες)');
    if (mb_strlen((string) $password) < 8) {
        $this->error('Ο κωδικός πρέπει να έχει τουλάχιστον 8 χαρακτήρες.');

        return 1;
    }

    $user->update(['password' => $password]);
    $this->info("Ο κωδικός του {$email} άλλαξε.");
})->purpose('Αλλαγή κωδικού λογαριασμού διαχείρισης');

Artisan::command('users:list', function () {
    $this->table(['Όνομα', 'Email', 'Ρόλος'], User::orderBy('id')->get(['name', 'email', 'role'])->toArray());
})->purpose('Λίστα λογαριασμών διαχείρισης');

Artisan::command('appointments:send-reminders', function () {
    $appointments = Appointment::where('status', 1)
        ->whereDate('appointment_date', now()->addDay()->toDateString())
        ->whereNull('reminder_sent_at')
        ->whereNotNull('customer_email')
        ->get();

    $sent = 0;
    foreach ($appointments as $appointment) {
        try {
            Mail::to($appointment->customer_email)->send(new AppointmentReminder($appointment));
            $appointment->forceFill(['reminder_sent_at' => now()])->save();
            $sent++;
        } catch (\Throwable $e) {
            Log::error('Αποτυχία υπενθύμισης ραντεβού #' . $appointment->id . ': ' . $e->getMessage());
        }
    }

    $this->info("Στάλθηκαν {$sent} από {$appointments->count()} υπενθυμίσεις.");
})->purpose('Email υπενθύμισης για τα ραντεβού πλυντηρίου της επόμενης ημέρας');

Artisan::command('prices:refresh', function (FuelPriceScraper $scraper) {
    foreach (array_keys(config('stations')) as $id) {
        $prices = $scraper->refresh($id);
        $found = collect($prices)->reject(fn ($price) => $price === '-')->count();
        $this->line(config("stations.$id.title") . ": {$found} τιμές");
    }
})->purpose('Ανανέωση τιμών καυσίμων από το vrisko.gr');

Schedule::command('prices:refresh')->cron('5 */3 * * *')->withoutOverlapping();
Schedule::command('appointments:send-reminders')->dailyAt('18:00')->withoutOverlapping();
