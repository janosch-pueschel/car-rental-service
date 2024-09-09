<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index(Booking $bookings)
        {
            $bookings = $bookings->with('driver', 'vehicleCategory', 'fuelType', 'transmission')->orderBy('departure', 'asc')->get();

            return Inertia::render('Booking/Index', [
                'bookings' => $bookings
            ]);
        }

    public function create() {
        return Inertia::render('Booking/Create');
    }

    public function store(Request $request) {
        $request->validate([
            'departure' => 'required',
            'return' => 'required',
            'category' => 'required',
            'fuelType' => 'required',
            'transmission' => ['required_if:fuelType,gasoline,fuelType,diesel'],
            'firstName' => 'required',
            'lastName' => 'required',
            'gender' => 'required',
            'birthdate' => 'required',
            'email' => 'required',
        ]);

        $driverId = Driver::firstOrCreate([
            'first_name' => $request['firstName'],
            'last_name' => $request['lastName'],
            'gender' => $request['gender'],
            'birthdate' => $request['birthdate'],
            'email' => $request['email']
        ])->id;
        $vehicleCategoryId = VehicleCategory::firstWhere('name', $request['category'])->id;
        $fuelTypeId = FuelType::firstWhere('name', $request['fuelType'])->id;
        $transmissionId = Transmission::firstWhere('name', $request['transmission'])->id ?? Transmission::firstWhere('name', 'Automatic')->id;

        Booking::create([
            'departure' => $request['departure'],
            'return' => $request['return'],
            'driver_id' => $driverId,
            'vehicle_category_id' => $vehicleCategoryId,
            'fuel_type_id' => $fuelTypeId,
            'transmission_id' => $transmissionId,
            'price_per_day' => 10
        ]);

        return redirect('/booking');
    }
}


 /* $requestData = json_decode($request->getContent(), true);

        $driver = [
            'first_name' => $requestData['firstName'],
            'last_name' => $requestData['lastName'],
            'gender' => $requestData['gender'],
            'birthdate' => $requestData['birthdate'],
            'email' => $requestData['email']
        ];

        $driverId = Driver::firstOrCreate([
            'first_name' => $requestData['firstName'],
            'last_name' => $requestData['lastName'],
            'gender' => $requestData['gender'],
            'birthdate' => $requestData['birthdate'],
            'email' => $requestData['email']
        ], [
            'first_name' => $requestData['firstName'],
            'last_name' => $requestData['lastName'],
            'gender' => $requestData['gender'],
            'birthdate' => $requestData['birthdate'],
            'email' => $requestData['email']
        ]); */ 

        /* $driverId = Driver::firstOrCreate([
            'first_name' => $request['firstName'],
            'last_name' => $request['lastName'],
            'gender' => $request['gender'],
            'birthdate' => $request['birthdate'],
            'email' => $request['email']
        ])->id; */