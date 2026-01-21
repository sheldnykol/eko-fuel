<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/station/{id}', [StationController::class, 'show'])->name('station.show');