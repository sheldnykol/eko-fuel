<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelOrder;
use App\Models\Station;
use App\Models\HeatingOilOrder;
use App\Models\LpgOrder;
use Illuminate\Support\Facades\Log;

class FuelOrderController extends Controller
{
    public function adminIndex($type = 'fuel')
    {
        if ($type == 'lpg') {
            $orders = LpgOrder::latest()->get();
        } elseif ($type == 'heating') {
            $orders = HeatingOilOrder::latest()->get();
        } else {
            $type = 'fuel';
            $orders = FuelOrder::latest()->get();
        }

        $counts = [
            'fuel' => FuelOrder::count(),
            'lpg' => LpgOrder::count(),
            'heating' => HeatingOilOrder::count(),
        ];

        return view('admin.fuel_orders', compact('orders', 'type', 'counts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fuel_name' => 'required|string|max:255',
            'fuel_phone' => 'required|digits:10',
            'fuel_afm' => 'required|digits:9',
            'fuel_city' => 'required|string|max:255',
            'fuel_address' => 'required|string|max:255',
            'fuel_number_address' => 'nullable|string|max:10',
            'fuel_type' => 'required|in:diesel_economy,diesel_avio',
            'fuel_quantity' => 'required|integer|min:1',
        ], [
            'fuel_phone.digits' => 'Το τηλέφωνο πρέπει να είναι ακριβώς 10 ψηφία.',
            'fuel_afm.digits' => 'Το ΑΦΜ πρέπει να είναι ακριβώς 9 ψηφία.',
            'fuel_type.in' => 'Επιλέξτε έναν έγκυρο τύπο καυσίμου.',
            'fuel_quantity.min' => 'Η ποσότητα πρέπει να είναι τουλάχιστον 1 λίτρο.',
        ]);

        $validated['fuel_name'] = mb_strtoupper($request->fuel_name, 'UTF-8');
        $validated['fuel_city'] = mb_strtoupper($request->fuel_city, 'UTF-8');
        $validated['fuel_address'] = mb_strtoupper($request->fuel_address, 'UTF-8');

        try {
            FuelOrder::create($validated);

            Log::info('Η παραγγελία αποθηκεύτηκε επιτυχώς .');
        } catch (\Exception $e) {
            Log::error('Σφάλμα κατά την αποθήκευση της παραγγελίας: ' . $e->getMessage());
            return redirect()->back()->withErrors('Υπήρξε πρόβλημα κατά την αποθήκευση. Δοκιμάστε ξανά.');
        }

        return redirect()->back()->with('success', 'Η παραγγελία σας καταχωρήθηκε με επιτυχία!');
    }
}