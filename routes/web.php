<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FuelOrderController;

Route::get('/', function () {
  return view('pages.home');
});

Route::get('/station/{id}', [StationController::class, 'show'])->name('station.show');

Route::post('/book-wash', [BookingController::class, 'store'])->name('booking.store'); 

// Route::get('/booking', function () {
//     return view('pages.booking');
// })->name('pages.booking');

Route::get('/check-availability', [BookingController::class, 'checkAvailability']);


Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('pages.booking');


// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/appointment/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');


//Auth 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Middlewere : if user is not connected not allow access  

Route::middleware(['auth'])->group(function () {
  Route::get('/admin/admin', [AdminController::class, 'index'])->name('admin.admin');
  Route::get('/admin/stats', [AdminController::class, 'stats'])->name('admin.stats');
  Route::post('/admin/dashboard/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
});
// Η Σελίδα με τη Φόρμα Παραγγελίας Κινησης
Route::get('/order-fuel', function () {
    return view('partials.fuel_order_form');
})->name('fuel-orders.create');

// Η ενέργεια αποθήκευσης της παραγγελίας (POST) κινησησς
Route::post('/order-fuel', [FuelOrderController::class, 'order'])->name('fuel-orders.index');

// Η Σελίδα με τη Φόρμα Παραγγελίας Υγραεριου
Route::get('/lpg_orders', function () {
    return view('partials.lpg_order_form');
})->name('lpg-orders.create');

// Η ενέργεια αποθήκευσης της παραγγελίας (POST) Υγραεριου
Route::post('/lpg-orders', [FuelOrderController::class, 'order'])->name('lpg-orders.index');

// Η Σελίδα με τη Φόρμα Παραγγελίας Υγραεριου
Route::get('/lpg_orders', function () {
    return view('partials.lpg_order_form');
})->name('lpg-orders.create');

// Η ενέργεια αποθήκευσης της παραγγελίας (POST) Υγραεριου
Route::post('/lpg-orders', [FuelOrderController::class, 'order'])->name('lpg-orders.index');

// Η Σελίδα με τη Φόρμα Παραγγελίας Θέρμανσης
Route::get('/heatingOil_orders', function () {
    return view('partials.heatingOil_order_form');
})->name('heatingOil-orders.create');

// Η ενέργεια αποθήκευσης της παραγγελίας (POST) Θέρμανσης
Route::post('/heatingOil-orders', [FuelOrderController::class, 'order'])->name('heatingOil-orders.index');



// --- ROUTES ΓΙΑ ΤΟΝ ADMIN (Backend) ---

// Η σελίδα όπου ο Admin βλέπει όλες τις παραγγελίες Κινησης
Route::get('/admin/fuel-orders', [FuelOrderController::class, 'index'])->name('admin.fuel-orders');

// Η σελίδα όπου ο Admin βλέπει όλες τις παραγγελίες Υγραεριου
Route::get('/admin/lpg-orders', [FuelOrderController::class, 'index'])->name('admin.lpg-orders');

// Η σελίδα όπου ο Admin βλέπει όλες τις παραγγελίες Θερμανσης
Route::get('/admin/heatingOil-orders', [FuelOrderController::class, 'index'])->name('admin.heatingOil-orders');

