<?php

use App\Http\Controllers\BookingController;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/bookings', [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);

Route::get('/bookings/create', [BookingController::class, 'create']);

Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
Route::patch('/bookings/{id}', [BookingController::class, 'update']);

Route::get('/bookings/{id}/edit', [BookingController::class, 'edit']);

Route::get('/drivers', function(){
    return Inertia::render('Drivers');
});