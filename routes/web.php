<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CancellationController;
use App\Http\Controllers\FuelOrderController;
use App\Http\Controllers\FuelPricesController;
use App\Http\Controllers\HeatingOilOrderController;
use App\Http\Controllers\LpgOrderController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\StationController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('pages.home'));
Route::get('/contact', [StationController::class, 'showStations'])->name('stations.show');
Route::get('/services', fn () => view('pages.services'));
Route::get('/terms', fn () => view('pages.terms'));
Route::get('/privacy', fn () => view('pages.privacy'));
Route::get('/infoGeneration', fn () => view('pages.infoGeneration'));

Route::get('/sitemap.xml', [SeoController::class, 'sitemap']);
Route::get('/robots.txt', [SeoController::class, 'robots']);

Route::get('/order-fuel', fn () => view('partials.fuel_order_form'))->name('fuel-orders.create');
Route::post('/order-fuel', [FuelOrderController::class, 'store'])->name('fuel-orders.store');
Route::get('/lpg-orders', fn () => view('partials.lpg_order_form'))->name('lpg-orders.create');
Route::post('/lpg-orders', [LpgOrderController::class, 'store'])->name('lpg-orders.store');
Route::get('/heating-oil-orders', fn () => view('partials.heating_oil_order_form'))->name('heating-oil-orders.create');
Route::post('/heating-oil-orders', [HeatingOilOrderController::class, 'store'])->name('heating-oil-orders.store');

Route::get('/fuel', [FuelPricesController::class, 'getVriskoPrices'])->name('fuel-prices');

Route::get('/station/{id}', [StationController::class, 'show'])->whereNumber('id')->name('station.show');
Route::get('/station/{id}/products', [StationController::class, 'showProducts'])->whereNumber('id')->name('station.products');

Route::get('/booking', [BookingController::class, 'index'])->name('pages.booking');
Route::get('/check-availability', [BookingController::class, 'checkAvailability']);
Route::get('/get-available-slots', [BookingController::class, 'getAvailableSlots']);
Route::post('/book-wash', [BookingController::class, 'store'])->middleware('throttle:10,1')->name('booking.store');

Route::get('/cancellation', [CancellationController::class, 'index'])->middleware('throttle:20,1')->name('cancellation.page');
Route::get('/appointment/{appointment}/cancel', [CancellationController::class, 'confirm'])->middleware('signed')->name('cancellation.confirm');
Route::post('/appointment/{appointment}/cancel', [CancellationController::class, 'cancel'])->middleware('signed')->name('cancellation.perform');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/admin', [AdminController::class, 'index'])->name('admin.admin');
    Route::post('/admin/dashboard/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::post('/admin/appointments/{id}/comments', [AdminController::class, 'storeComment'])->name('admin.comments.store');
    Route::get('/admin/comments', [AdminController::class, 'allComments'])->name('admin.comments.index');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/admin/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.exportPDF');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/stats', [AdminController::class, 'stats'])->name('admin.stats');
        Route::get('/admin/fuel-orders/{type?}', [FuelOrderController::class, 'adminIndex'])->name('admin.fuel-orders');

        Route::get('/admin/products', [AdminController::class, 'adminProducts'])->name('admin.products.index');
        Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
        Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('admin.products.store');
        Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
        Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
        Route::delete('/admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

        Route::get('/admin/schedules', [AdminController::class, 'manageSchedules'])->name('admin.schedules.index');
        Route::post('/admin/schedules/store', [AdminController::class, 'storeSchedule'])->name('admin.schedules.store');
        Route::get('/admin/schedules/day', [AdminController::class, 'scheduleDay'])->name('admin.schedules.day');
        Route::post('/admin/schedules/reset', [AdminController::class, 'resetSchedule'])->name('admin.schedules.reset');
    });
});
