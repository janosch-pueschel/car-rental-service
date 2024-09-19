<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Booking $bookings)
    {
        $bookings = $bookings::whereDate('departure', '=', Carbon::today())
            ->with('driver', 'vehicleCategory', 'fuelType', 'transmission')
            ->orderBy('departure', 'asc')
            ->paginate(10);

        return Inertia::render('Home', [
            'bookings' => $bookings
        ]);
    }
}
