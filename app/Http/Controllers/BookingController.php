<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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
}