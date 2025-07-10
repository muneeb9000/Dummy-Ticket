<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


Route::name('website.')->controller(WebsiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/flight-reservation', 'flightReservation')->name('flight');
    Route::get('/contact-us', 'contactUs')->name('contact');
    Route::get('/correction-policy', 'correctionPolicy')->name('correction.policy');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/refund-policy', 'refundPolicy')->name('refund.policy');
    Route::get('/reviews', 'reviews')->name('reviews');
    Route::get('/terms-conditions', 'termsConditions')->name('terms.conditions');
});



Route::middleware('auth')->group(function () {
   
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
