<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Αν ο χρήστης διάλεξε ημερομηνία, την παίρνουμε. Αλλιώς, παίρνουμε το σήμερα.
        $selectedDate = $request->query('date', date('Y-m-d'));

        // Φέρνουμε τα ραντεβού για τη συγκεκριμένη ημερομηνία
        $appointments = Appointment::where('appointment_date', $selectedDate)
            ->orderBy('appointment_time', 'asc')
            ->get();

        return view('admin.dashboard', compact('appointments', 'selectedDate'));
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => $request->status]);

        return back()->with('success', 'Η κατάσταση ενημερώθηκε!');
    }
}