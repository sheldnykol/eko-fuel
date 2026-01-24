<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

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
  Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
  Route::get('/admin/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.exportPDF');

  // --- ΤΑ ROUTES ΓΙΑ ΤΑ ΠΡΟΪΟΝΤΑ ΠΟΥ ΕΛΕΙΠΑΝ ---
    // Η λίστα (αυτό που σου χτυπάει τώρα)
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
});
// Σελίδα Προϊόντων ανά Πρατήριο
Route::get('/station/{id}/products', [StationController::class, 'showProducts'])->name('station.products');
    
