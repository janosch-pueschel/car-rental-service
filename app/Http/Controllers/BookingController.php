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
        /* $messages = [
            'required' => ':attribute is required.',
            'after' => ':attribute must be in the future.'
        ]; */

        $request->validate([
            'departure' => ['required', 'date_format:Y-m-d\TH:i', 'after:now'],
            'return' => ['required', 'date_format:Y-m-d\TH:i', 'after:departure'],
            'category' => ['required', 'string', 'max:255'],
            'fuelType' => ['required', 'string', 'max:255'],
            'transmission' => ['required_if:fuelType,gasoline,fuelType,diesel'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'email' => ['required', 'email'],
        ], [
            'required' => ':attribute is required.',
            'departure.after' => ':attribute date must be in the future.',
            'return.after' => ':attribute date must after departure date.'
        ], [
            'departure' => 'Departure',
            'return' => 'Return',
            'category' => 'Vehicle category',
            'fuelType' => 'Fuel type',
            'transmission' => 'Transmission',
            'firstName' => 'First name',
            'lastName' => 'Last name',
            'gender' => 'Gender',
            'birthdate' => 'Birthdate',
            'email' => 'Email',
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