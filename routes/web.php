<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::get('/', [WebsiteController::class, 'index'])->name('home');
Route::get('/flight-reservation', [WebsiteController::class, 'flightReservation'])->name('flight');

Route::middleware('auth')->group(function () {
   
});

require __DIR__.'/auth.php';
