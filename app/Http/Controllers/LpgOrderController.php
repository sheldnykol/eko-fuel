<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LpgOrder;
use App\Models\Station;
use Illuminate\Support\Facades\Log; // Απαραίτητο για το Log


class LpgOrderController extends Controller
{
     /**
     * Εμφάνιση της λίστας παραγγελιών (για τον Admin)
     */
    public function store()
    {
        $orders = LpgOrder::latest()->get();
        return view('admin.customer_lpg_orders', compact('lpg_orders'));
    }

    /**
     * Αποθήκευση της παραγγελίας από τον χρήστη
     */
    public function order(Request $request) 
    {

        \App\Models\LpgOrder::create($request->all());
        // 1. LOG: Καταγραφή των δεδομένων που έρχονται από τη φόρμα
        Log::info('Νέα εισερχόμενη παραγγελία καυσίμου:', $request->all());

        $validated = $request->validate([
            'customer_lpg_name' => 'required|string|max:255',
            'customer_lpg_phone' => 'required|digits:10',
            'customer_lpg_afm' => 'required|digits:9',
            'customer_lpg_city' => 'required|string|max:255',
            'customer_lpg_address' => 'required|string|max:255',
            'customer_lpg_number_of_address' => 'required|integer|digits_between:1,4',
            'lpg_type' => 'required',
            'lpg_quantity' => 'required|integer|min:1',
        ], [
            // Custom μηνύματα σφάλματος
            'customer_lpg_phone.digits' => 'Το τηλέφωνο πρέπει να είναι ακριβώς 10 ψηφία.',
            'customer_lpg_afm.digits' => 'Το ΑΦΜ πρέπει να είναι ακριβώς 9 ψηφία.',
            'customer_lpg_number_of_address.digits_between' => 'Ο αριθμός διεύθυνσης πρέπει να είναι από 1 έως 4 ψηφία.',
            'lpg_quantity.min' => 'Η ποσότητα πρέπει να είναι τουλάχιστον 1 λίτρο.',
        ]);

        // 3. Μετατροπή σε κεφαλαία (Χρησιμοποιούμε mb_strtoupper για σωστά ελληνικά)
        $validated['customer_lpg_name'] = mb_strtoupper($request->customer_lpg_name, 'UTF-8');
        $validated['customer_lpg_city'] = mb_strtoupper($request->customer_lpg_city, 'UTF-8');
        $validated['customer_lpg_address'] = mb_strtoupper($request->customer_lpg_address, 'UTF-8');

        try {
            LpgOrder::create($validated);
            Log::info('Η παραγγελία αποθηκεύτηκε επιτυχώς στη βάση.');
        } catch (\Exception $e) {
            Log::error('Σφάλμα κατά την αποθήκευση της παραγγελίας: ' . $e->getMessage());
            return redirect()->back()->withErrors('Υπήρξε πρόβλημα κατά την αποθήκευση. Δοκιμάστε ξανά.');
        }

        // 5. Επιστροφή με μήνυμα επιτυχίας
        return redirect()->back()->with('success', 'Η παραγγελία σας καταχωρήθηκε με επιτυχία!');

    }
}