<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index']);
    
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    
    Route::get('/bookings/create', [BookingController::class, 'create']);
    
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
    Route::patch('/bookings/{id}', [BookingController::class, 'update']);
    
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit']);
    
    Route::post('/logout', [LoginController::class, 'destroy']);
});

