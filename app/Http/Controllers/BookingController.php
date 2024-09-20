<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index(Request $request, Booking $booking) {
        $search = $request['search'];

        $bookings = $booking::query()
                ->with('driver', 'vehicleCategory', 'fuelType', 'transmission')->orderBy('departure', 'asc')
                ->when($search, function ($query, $search) {
                    $query->whereHas('driver', function ($query) use ($search) {
                        $query->where('last_name', 'like', "%{$search}%")
                              ->orWhere('first_name', 'like', "%{$search}%");
                    });
                })
                ->simplePaginate(10)
                ->withQueryString();


            return Inertia::render('Booking/Index', [
                'bookings' => $bookings,
                'searchFilter' => $request->query('search')
            ]);
        
    }

    public function create() {
        return Inertia::render('Booking/Create');
    }

    public function store(Request $request) {
        $request['departure'] = date("Y-m-d H:i:s", strtotime($request["departure"]));
        $request['return'] = date("Y-m-d H:i:s", strtotime($request["return"]));

        $validatedData = $request->validate([
            'departure' => ['required', 'date_format:Y-m-d H:i:s', 'after:now'],
            'return' => ['required', 'date_format:Y-m-d H:i:s', 'after:departure'],
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
            'first_name' => $validatedData['firstName'],
            'last_name' => $validatedData['lastName'],
            'gender' => $validatedData['gender'],
            'birthdate' => $validatedData['birthdate'],
            'email' => $validatedData['email']
        ])->id;
        
        $vehicleCategory = VehicleCategory::firstWhere('name', $validatedData['category']);
        $fuelType = FuelType::firstWhere('name', $validatedData['fuelType']);
        $transmission = Transmission::firstWhere('name', $validatedData['transmission']) ?? Transmission::firstWhere('name', 'Automatic');

        $pricePerDay = $vehicleCategory->price_per_day + $fuelType->price_per_day + $transmission->price_per_day;
        $total_days = ceil(Carbon::parse($validatedData['departure'])->diffInDays(Carbon::parse($validatedData['return'])));
        $price_total = round($total_days * $pricePerDay, 2);
    

        Booking::create([
            'departure' => $request['departure'],
            'return' => $request['return'],
            'total_days' => $total_days,
            'driver_id' => $driverId,
            'vehicle_category_id' => $vehicleCategory->id,
            'fuel_type_id' => $fuelType->id,
            'transmission_id' => $transmission->id,
            'price_per_day' => $pricePerDay,
            'price_total' => $price_total
        ]);

        return redirect('/bookings')->with([
            'message' => 'Booking created.',
            'message_type' => 'success'
        ]);;
    }

    public function show($id) {
        $booking = Booking::find($id);

        return Inertia::render('Booking/Show')->with([
            'booking' => $booking,
            'driver' => $booking->driver,
            'vehicleCategory' => $booking->vehicleCategory,
            'fuelType' => $booking->fuelType,
            'transmission' => $booking->transmission
        ]);
    }

    public function destroy($id) {
        Booking::find($id)->delete();
        return redirect('/bookings')->with([
            'message' => 'Booking deleted.',
            'message_type' => 'success'
        ]);
    }

    public function edit($id) {
        $booking = Booking::findOrFail($id);
    
        return Inertia::render('Booking/Edit', [
            'booking' => [
                'id' => $id,
                'departure' => $booking->departure,
                'return' => $booking->return,
                'category' => $booking->vehicleCategory->name,
                'fuelType' => $booking->fuelType->name,
                'transmission' => $booking->transmission->name,
            ]
        ]);
    }

    public function update(Request $request, $bookingId) {
       $request['departure'] = date("Y-m-d H:i:s", strtotime($request["departure"]));
       $request['return'] = date("Y-m-d H:i:s", strtotime($request["return"]));

        $validatedData =  $request->validate([
            'departure' => ['required', 'date_format:Y-m-d H:i:s'],
            'return' => ['required', 'date_format:Y-m-d H:i:s', 'after:departure'],
            'category' => ['required', 'string', 'max:255'],
            'fuelType' => ['required', 'string', 'max:255'],
            'transmission' => ['required_if:fuelType,gasoline,fuelType,diesel'],
        ], [
            'required' => ':attribute is required.',
            'return.after' => ':attribute date must after departure date.'
        ], [
            'departure' => 'Departure',
            'return' => 'Return',
            'category' => 'Vehicle category',
            'fuelType' => 'Fuel type',
            'transmission' => 'Transmission',
        ]);

        $booking = Booking::findOrFail($bookingId);

        $vehicleCategoryId = VehicleCategory::firstWhere('name', $validatedData['category'])->id;
        $fuelTypeId = FuelType::firstWhere('name', $validatedData['fuelType'])->id;
        $transmissionId = Transmission::firstWhere('name', $validatedData['transmission'])->id ?? Transmission::firstWhere('name', 'Automatic')->id;
        
        $booking->update([
            'departure' => $validatedData['departure'],
            'return' => $validatedData['return'],
            'vehicle_category_id' => $vehicleCategoryId,
            'fuel_type_id' => $fuelTypeId,
            'transmission_id' => $transmissionId,
            'price_per_day' => 10
        ]);

        return redirect()->route('bookings.show', ['id' => $bookingId])->with([
            'message' => 'Booking updated.',
            'message_type' => 'success'
        ]);;
    }
}