<?php

use App\Http\Controllers\BookingController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/booking', [BookingController::class, 'index']);

Route::get('/drivers', function(){
    return Inertia::render('Drivers');
});