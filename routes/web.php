<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, StationController, BookingController, 
    AdminController, FuelOrderController, HeatingOilOrderController, LpgOrderController
};

// --- FRONTEND ROUTES ---
Route::get('/', function () { return view('pages.home'); });

Route::get('/contact', [StationController::class, 'showStations'])->name('stations.show');

Route::get('/services', function () { return view('pages.services'); });

Route::get('/terms', function () { return view('pages.terms'); });

Route::get('/privacy', function () { return view('pages.privacy'); });

Route::get('/station/{id}', [StationController::class, 'show'])->name('station.show');

Route::get('/station/{id}/products', [StationController::class, 'showProducts'])->name('station.products');

// Car-Wash
Route::get('/booking', [BookingController::class, 'index'])->name('pages.booking');
Route::get('/check-availability', [BookingController::class, 'checkAvailability']);
Route::get('/get-available-slots', [BookingController::class, 'getAvailableSlots']);
Route::post('/book-wash', [BookingController::class, 'store'])->name('booking.store'); 

// --- ΠΑΡΑΓΓΕΛΙΕΣ ΠΕΛΑΤΩΝ ---

// Fuel
Route::get('/order-fuel', function () { return view('partials.fuel_order_form'); })->name('fuel-orders.create');
Route::post('/order-fuel', [FuelOrderController::class, 'store'])->name('fuel-orders.store');

// LPG
Route::get('/lpg-orders', function () { return view('partials.lpg_order_form'); })->name('lpg-orders.create');
Route::post('/lpg-orders', [LpgOrderController::class, 'store'])->name('lpg-orders.store');

// Heating Oil
Route::get('/heating-oil-orders', function () { return view('partials.heating_oil_order_form'); })->name('heating-oil-orders.create');
Route::post('/heating-oil-orders', [HeatingOilOrderController::class, 'store'])->name('heating-oil-orders.store');

// --- AUTH ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- ADMIN ROUTES (Με Middleware) ---
Route::middleware(['auth'])->group(function () {
    // Dashboard & Stats
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/admin', [AdminController::class, 'index'])->name('admin.admin');
    Route::get('/admin/stats', [AdminController::class, 'stats'])->name('admin.stats');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admin/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.exportPDF');
    
    // Status Updates
    Route::post('/admin/dashboard/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::post('/admin/appointment/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');

    // Orders Lists
    Route::get('/admin/fuel-orders', [FuelOrderController::class, 'index'])->name('admin.fuel-orders.index');
    Route::get('/admin/lpg-orders', [LpgOrderController::class, 'index'])->name('admin.lpg-orders.index');
    Route::get('/admin/heating-oil-orders', [HeatingOilOrderController::class, 'index'])->name('admin.heating-oil-orders.index');

    // Products Management
    Route::get('/admin/products', [AdminController::class, 'adminProducts'])->name('admin.products.index');
    Route::get('/admin/products/create', function() {
        return view('admin.products.create', ['stations' => config('stations')]);
    })->name('admin.products.create');
    Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

    // Wash Schedules
    Route::get('/admin/schedules', [AdminController::class, 'manageSchedules'])->name('admin.schedules.index');
    Route::post('/admin/schedules/store', [AdminController::class, 'storeSchedule'])->name('admin.schedules.store');
});