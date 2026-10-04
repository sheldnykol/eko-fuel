<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LpgOrder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewLpgOrderMail;

class LpgOrderController extends Controller
{
    public function index()
    {
        $orders = LpgOrder::latest()->get();
        return view('admin.customer_lpg_orders', ['lpg_orders' => $orders]);
    }

    public function store(Request $request)
    {
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

        $validated['lpg_name'] = mb_strtoupper($validated['lpg_name'], 'UTF-8');
        $validated['lpg_city'] = mb_strtoupper($validated['lpg_city'], 'UTF-8');
        $validated['lpg_address'] = mb_strtoupper($validated['lpg_address'], 'UTF-8');

        try {
            $order = LpgOrder::create($validated);
            Log::info('Η παραγγελία LPG αποθηκεύτηκε επιτυχώς με ID: ' . $order->id);
        } catch (\Exception $e) {
            Log::error('Σφάλμα κατά την αποθήκευση LPG στη βάση: ' . $e->getMessage());
            return redirect()->back()->withErrors('Υπήρξε πρόβλημα κατά την αποθήκευση της παραγγελίας. Δοκιμάστε ξανά.')->withInput();
        }

        try {
            Mail::to('fueldramis@outlook.com')->send(new NewLpgOrderMail($order));
            Log::info('Το email για την παραγγελία LPG εστάλη επιτυχώς.');
        } catch (\Exception $e) {
            Log::error('ΠΡΟΣΟΧΗ: Η παραγγελία αποθηκεύτηκε, αλλά το email απέτυχε. Σφάλμα: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Η παραγγελία σας καταχωρήθηκε με επιτυχία!');
    }
}