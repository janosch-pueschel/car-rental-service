<?php

use App\Http\Controllers\BookingController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/booking', [BookingController::class, 'index']);
Route::post('/booking', [BookingController::class, 'store']);
Route::get('/booking/create', [BookingController::class, 'create']);
Route::get('/booking/show/{id}', [BookingController::class, 'show']);
Route::delete('/booking/show/{id}', [BookingController::class, 'destroy']);

Route::get('/drivers', function(){
    return Inertia::render('Drivers');
});