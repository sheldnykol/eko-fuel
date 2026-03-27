<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\FuelOrderController;


//NAV routes
////HomePage

Route::get('/', function () {
  return view('pages.home');
});
////Contact
Route::get('/contact', [StationController::class, 'showStations'])->name('stations.show');
////services
Route::get('/services', function () {
  return view('pages.services');
});
////Terms
Route::get('/terms', function (){
  return view('pages.terms');
});
////Privacy
Route::get('/privacy', function (){
  return view('pages.privacy');
});

////Gus station based id 
Route::get('/station/{id}', [StationController::class, 'show'])->name('station.show');

////Car-Wash Appointment 
Route::get('/booking', [BookingController::class, 'index'])->name('pages.booking');
Route::get('/check-availability', [BookingController::class, 'checkAvailability']);
Route::get('/get-available-slots', [BookingController::class, 'getAvailableSlots']);
Route::post('/book-wash', [BookingController::class, 'store'])->name('booking.store'); 

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

  Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
  Route::get('/admin/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.exportPDF');
    // Products
  Route::get('/admin/products', [AdminController::class, 'adminProducts'])->name('admin.products.index');
    
    // Η φόρμα δημιουργίας
  Route::get('/admin/products/create', function() {
        return view('admin.products.create', ['stations' => config('stations')]);
    })->name('admin.products.create');
    
    // Η αποθήκευση στη βάση
  Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    
    // Επεξεργασία και Διαγραφή
  Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
  Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
  Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

    //  Wash hours
  Route::get('/admin/schedules', [AdminController::class, 'manageSchedules'])->name('admin.schedules.index');
  Route::post('/admin/schedules/store', [AdminController::class, 'storeSchedule'])->name('admin.schedules.store');

// Σελίδα Προϊόντων ανά Πρατήριο
Route::get('/station/{id}/products', [StationController::class, 'showProducts'])->name('station.products');
    
