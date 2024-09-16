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

Route::get('/booking', [BookingController::class, 'index']);
Route::post('/booking', [BookingController::class, 'store']);
Route::get('/booking/create', [BookingController::class, 'create']);
Route::get('/booking/show/{id}', [BookingController::class, 'show']);
Route::delete('/booking/show/{id}', [BookingController::class, 'destroy']);
Route::get('/booking/edit/{id}', function($id){
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
Route::patch('/booking/edit/{id}', [BookingController::class, 'update']);

Route::get('/drivers', function(){
    return Inertia::render('Drivers');
});