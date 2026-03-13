<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeatingOilOrderController extends Controller
{
         /**
     * Εμφάνιση της λίστας παραγγελιών (για τον Admin)
     */
    public function index()
    {
        $orders = FuelOrder::latest()->get();
        return view('admin.customer_heatingOil_orders', compact('heatingOil_orders'));
    }

    /**
     * Αποθήκευση της παραγγελίας από τον χρήστη
     */
    public function order(Request $request) 
    {
        // 1. LOG: Καταγραφή των δεδομένων που έρχονται από τη φόρμα
        Log::info('Νέα εισερχόμενη παραγγελία καυσίμου:', $request->all());

        $validated = $request->validate([
            'customer_heatingOil_name' => 'required|string|max:255',
            'customer_heatingOil_phone' => 'required|digits:10',
            'customer_heatingOil_afm' => 'required|digits:9',
            'customer_heatingOil_city' => 'required|string|max:255',
            'customer_heatingOil_address' => 'required|string|max:255',
            'customer_heatingOil_number_of_address' => 'required|integer|digits_between:1,4',
            'heatingOil_quantity' => 'required|integer|min:1',
        ], [
            // Custom μηνύματα σφάλματος
            'customer_heatingOil_phone.digits' => 'Το τηλέφωνο πρέπει να είναι ακριβώς 10 ψηφία.',
            'customer_heatingOil_afm.digits' => 'Το ΑΦΜ πρέπει να είναι ακριβώς 9 ψηφία.',
            'customer_heatingOil_number_of_address.digits_between' => 'Ο αριθμός διεύθυνσης πρέπει να είναι από 1 έως 4 ψηφία.',
            'heatingOil_quantity.min' => 'Η ποσότητα πρέπει να είναι τουλάχιστον 1 λίτρο.',
        ]);

        // 3. Μετατροπή σε κεφαλαία (Χρησιμοποιούμε mb_strtoupper για σωστά ελληνικά)
        $validated['customer_heatingOil_name'] = mb_strtoupper($request->customer_heatingOil_name, 'UTF-8');
        $validated['customer_heatingOil_city'] = mb_strtoupper($request->customer_heatingOil_city, 'UTF-8');
        $validated['customer_heatingOil_address'] = mb_strtoupper($request->customer_heatingOil_address, 'UTF-8');

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
