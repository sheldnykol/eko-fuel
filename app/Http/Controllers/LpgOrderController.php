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
    public function index()
    {
        $orders = LpgOrder::latest()->get();
        // Διόρθωση: Το compact πρέπει να έχει το όνομα της μεταβλητής που ορίσαμε πάνω ($orders)
        return view('admin.customer_lpg_orders', ['lpg_orders' => $orders]);
    }

    /**
     * Αποθήκευση της παραγγελίας από τον χρήστη
     */
    public function store(Request $request) 
    {
        // 1. LOG: Καταγραφή αρχικών δεδομένων
        Log::info('Νέα εισερχόμενη παραγγελία LPG:', $request->all());

        // 2. VALIDATION
        $validated = $request->validate([
            'lpg_name' => 'required|string|max:255',
            'lpg_phone' => 'required|digits:10',
            'lpg_afm' => 'required|digits:9',
            'lpg_city' => 'required|string|max:255',
            'lpg_address' => 'required|string|max:255',
            'lpg_number_address' => 'nullable|string|max:10',
            'lpg_type' => 'required',
            'lpg_quantity' => 'required|numeric|min:1',
        ], [
            'lpg_phone.digits' => 'Το τηλέφωνο πρέπει να είναι ακριβώς 10 ψηφία.',
            'lpg_afm.digits' => 'Το ΑΦΜ πρέπει να είναι ακριβώς 9 ψηφία.',
            'lpg_quantity.min' => 'Η ποσότητα πρέπει να είναι τουλάχιστον 1 λίτρο.',
        ]);

        // 3. ΜΕΤΑΤΡΟΠΗ ΣΕ ΚΕΦΑΛΑΙΑ
        $validated['lpg_name'] = mb_strtoupper($validated['lpg_name'], 'UTF-8');
        $validated['lpg_city'] = mb_strtoupper($validated['lpg_city'], 'UTF-8');
        $validated['lpg_address'] = mb_strtoupper($validated['lpg_address'], 'UTF-8');

        // 4. ΑΠΟΘΗΚΕΥΣΗ (ΜΟΝΟ ΜΙΑ ΦΟΡΑ ΕΔΩ)
        try {
            LpgOrder::create($validated);
            Log::info('Η παραγγελία LPG αποθηκεύτηκε επιτυχώς.');
            return redirect()->back()->with('success', 'Η παραγγελία σας καταχωρήθηκε με επιτυχία!');
        } catch (\Exception $e) {
            Log::error('Σφάλμα κατά την αποθήκευση LPG: ' . $e->getMessage());
            return redirect()->back()->withErrors('Υπήρξε πρόβλημα κατά την αποθήκευση.')->withInput();
        }
    }
}