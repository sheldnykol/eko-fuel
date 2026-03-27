<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelOrder;
use App\Models\Station;
use Illuminate\Support\Facades\Log; // Απαραίτητο για το Log

class FuelOrderController extends Controller
{
    /**
     * Εμφάνιση της λίστας παραγγελιών (για τον Admin)
     */
    public function store()
    {
        $fuel_orders = FuelOrder::latest()->get();
        return view('admin.fuel_order', compact('fuel_orders'));
    }

    /**
     * Αποθήκευση της παραγγελίας από τον χρήστη
     */
    public function order(Request $request) 
    {
        // 1. LOG: Καταγραφή των δεδομένων που έρχονται από τη φόρμα
        Log::info('Νέα εισερχόμενη παραγγελία καυσίμου:', $request->all());

        // 2. Validation
        $validated = $request->validate([
            'customer_fuel_name' => 'required|string|max:255',
            'customer_fuel_phone' => 'required|digits:10',
            'customer_fuel_afm' => 'required|digits:9',
            'customer_fuel_city' => 'required|string|max:255',
            'customer_fuel_address' => 'required|string|max:255',
            'customer_fuel_number_of_address' => 'required|integer|digits_between:1,4',
            'fuel_type' => 'required|in:diesel_economy,diesel_avio',
            'fuel_quantity' => 'required|integer|min:1',
        ], [
            // Custom μηνύματα σφάλματος
            'customer_fuel_phone.digits' => 'Το τηλέφωνο πρέπει να είναι ακριβώς 10 ψηφία.',
            'customer_fuel_afm.digits' => 'Το ΑΦΜ πρέπει να είναι ακριβώς 9 ψηφία.',
            'customer_fuel_number_of_address.digits_between' => 'Ο αριθμός διεύθυνσης πρέπει να είναι από 1 έως 4 ψηφία.',
            'fuel_type.in' => 'Επιλέξτε έναν έγκυρο τύπο καυσίμου.',
            'fuel_quantity.min' => 'Η ποσότητα πρέπει να είναι τουλάχιστον 1 λίτρο.',
        ]);

        // 3. Μετατροπή σε κεφαλαία (Χρησιμοποιούμε mb_strtoupper για σωστά ελληνικά)
        $validated['customer_fuel_name'] = mb_strtoupper($request->customer_fuel_name, 'UTF-8');
        $validated['customer_fuel_city'] = mb_strtoupper($request->customer_fuel_city, 'UTF-8');
        $validated['customer_fuel_address'] = mb_strtoupper($request->customer_fuel_address, 'UTF-8');

        // 4. Αποθήκευση στην βάση
        try {
            FuelOrder::create($validated);
            Log::info('Η παραγγελία αποθηκεύτηκε επιτυχώς στη βάση.');
        } catch (\Exception $e) {
            Log::error('Σφάλμα κατά την αποθήκευση της παραγγελίας: ' . $e->getMessage());
            return redirect()->back()->withErrors('Υπήρξε πρόβλημα κατά την αποθήκευση. Δοκιμάστε ξανά.');
        }

        // 5. Επιστροφή με μήνυμα επιτυχίας
        return redirect()->back()->with('success', 'Η παραγγελία σας καταχωρήθηκε με επιτυχία!');
    }
}