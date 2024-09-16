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

Route::get('/bookings/{id}', [BookingController::class, 'show']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
Route::patch('/bookings/{id}', [BookingController::class, 'update']);

Route::get('/bookings/{id}/edit', function($id){
    $booking = Booking::find($id);
    $driver = Driver::find($booking->driver_id);
    $vehicleCategory = VehicleCategory::find($booking->vehicle_category_id);
    $fuelType = FuelType::find($booking->fuel_type_id);
    $transmission = Transmission::find($booking->transmission_id);

    return Inertia::render('Booking/Edit', [
        'booking' => [
            'id' => $id,
            'departure' => $booking->departure,
            'return' => $booking->return,
            'category' => $vehicleCategory->name,
            'fuelType' => $fuelType->name,
            'transmission' => $transmission->name,
            'firstName' => $driver->first_name,
            'lastName' => $driver->last_name,
            'gender' => $driver->gender,
            'birthdate' => $driver->birthdate,
            'email' => $driver->email,
        ]
    ]);
});

Route::get('/drivers', function(){
    return Inertia::render('Drivers');
});