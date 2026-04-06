<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeatingOilOrder;
use App\Models\Station;
use Illuminate\Support\Facades\Log;

class HeatingOilOrderController extends Controller
{
         /**
     * Εμφάνιση της λίστας παραγγελιών (για τον Admin)
     */
    public function index()
    {
        $orders = HeatingOilOrder::latest()->get();
        return view('admin.customer_heatingOil_orders', compact('heatingOil_orders'));
    }

    /**
     * Αποθήκευση της παραγγελίας από τον χρήστη
     */
    public function store(Request $request) 
    {
        



        // 1. LOG: Καταγραφή των δεδομένων που έρχονται από τη φόρμα
        Log::info('Νέα εισερχόμενη παραγγελία καυσίμου:', $request->all());

        $validated = $request->validate([
            'heatOil_name' => 'required|string|max:255',
            'heatOil_phone' => 'required|digits:10',
            'heatOil_afm' => 'required|digits:9',
            'heatOil_city' => 'required|string|max:255',
            'heatOil_address' => 'required|string|max:255',
            'heatOil_number_address' => 'nullable|string|max:10',
            'heatOil_quantity' => 'required|integer|min:1',
        ], [
            // Custom μηνύματα σφάλματος
            'heatOil_phone.digits' => 'Το τηλέφωνο πρέπει να είναι ακριβώς 10 ψηφία.',
            'heatOil_afm.digits' => 'Το ΑΦΜ πρέπει να είναι ακριβώς 9 ψηφία.',
            'heatOil_quantity.min' => 'Η ποσότητα πρέπει να είναι τουλάχιστον 1 λίτρο.',
        ]);

        // 3. Μετατροπή σε κεφαλαία (Χρησιμοποιούμε mb_strtoupper για σωστά ελληνικά)
        $validated['heatOil_name'] = mb_strtoupper($request->heatOil_name, 'UTF-8');
        $validated['heatOil_city'] = mb_strtoupper($request->heatOil_city, 'UTF-8');
        $validated['heatOil_address'] = mb_strtoupper($request->heatOil_address, 'UTF-8');

        try {
            HeatingOilOrder::create($validated);
            Log::info('Η παραγγελία αποθηκεύτηκε επιτυχώς στη βάση.');
        } catch (\Exception $e) {
            Log::error('Σφάλμα κατά την αποθήκευση της παραγγελίας: ' . $e->getMessage());
            return redirect()->back()->withErrors('Υπήρξε πρόβλημα κατά την αποθήκευση. Δοκιμάστε ξανά.');
        }

        // 5. Επιστροφή με μήνυμα επιτυχίας
        return redirect()->back()->with('success', 'Η παραγγελία σας καταχωρήθηκε με επιτυχία!');

    }
}
