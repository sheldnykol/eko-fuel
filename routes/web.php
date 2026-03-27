<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FuelOrderController;
use App\Http\Controllers\LpgOrderController;
use App\Http\Controllers\HeatingOilOrderController;

// --- NAV routes (Public) ---

// HomePage
Route::get('/', function () {
    return view('pages.home');
});

// Contact
Route::get('/contact', [StationController::class, 'showStations'])->name('stations.show');

// Services
Route::get('/services', function () {
    return view('pages.services');
});

// Terms
Route::get('/terms', function (){
    return view('pages.terms');
});

// Privacy
Route::get('/privacy', function (){
    return view('pages.privacy');
});

// Gas station based id 
Route::get('/station/{id}', [StationController::class, 'show'])->name('station.show');

// Σελίδα Προϊόντων ανά Πρατήριο
Route::get('/station/{id}/products', [StationController::class, 'showProducts'])->name('station.products');

// Car-Wash Appointment 
Route::get('/booking', [BookingController::class, 'index'])->name('pages.booking');
Route::get('/check-availability', [BookingController::class, 'checkAvailability']);
Route::get('/get-available-slots', [BookingController::class, 'getAvailableSlots']);
Route::post('/book-wash', [BookingController::class, 'store'])->name('booking.store'); 

// Φόρμες Παραγγελιών
// Κίνηση
Route::get('/order-fuel', function () {
    return view('partials.fuel_order_form');
})->name('fuel-orders.create');
Route::post('/order-fuel', [FuelOrderController::class, 'order'])->name('fuel-orders.store');

// Υγραέριο
Route::get('/lpg_orders', function () {
    return view('partials.lpg_order_form');
})->name('lpg-orders.create');
Route::post('/lpg-orders', [LpgOrderController::class, 'order'])->name('lpg-orders.store');

// Θέρμανση
// Η Σελίδα με τη Φόρμα Παραγγελίας Θέρμανσης (GET)
Route::get('/heating-oil-orders', function () {
    return view('partials.heatingOil_order_form');
})->name('heating-οil-orders.create');

// Η ενέργεια αποθήκευσης της παραγγελίας (POST)
Route::post('/heating-oil-orders', [HeatingOilOrderController::class, 'order'])->name('heating-οil-orders.store');


// --- Auth Routes ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- Middleware: Μόνο για συνδεδεμένους (Admin) ---

Route::middleware(['auth'])->group(function () {
    
    // Admin Dashboard & Stats
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/admin', [AdminController::class, 'index'])->name('admin.admin');
    Route::get('/admin/stats', [AdminController::class, 'stats'])->name('admin.stats');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admin/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.exportPDF');
    
    // Status Updates
    Route::post('/admin/appointment/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::post('/admin/dashboard/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');

    // Διαχείριση Παραγγελιών (Backend)
    Route::get('/admin/fuel-orders', [FuelOrderController::class, 'index'])->name('admin.fuel-orders');
    Route::get('/admin/lpg-orders', [LpgOrderController::class, 'index'])->name('admin.lpg-orders');
    Route::get('/admin/heatingOil-orders', [HeatingOilOrderController::class, 'index'])->name('admin.heatingOil-orders');

    // Products Management
    Route::get('/admin/products', [AdminController::class, 'adminProducts'])->name('admin.products.index');
    
    Route::get('/admin/products/create', function() {
        return view('admin.products.create', ['stations' => config('stations')]);
    })->name('admin.products.create');
    
    Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

    // Wash Hours / Schedules
    Route::get('/admin/schedules', [AdminController::class, 'manageSchedules'])->name('admin.schedules.index');
    Route::post('/admin/schedules/store', [AdminController::class, 'storeSchedule'])->name('admin.schedules.store');
});
