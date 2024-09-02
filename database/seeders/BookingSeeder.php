<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::factory(15)->create();
        VehicleCategory::factory(7)->create();
        FuelType::factory(3)->create();
        Transmission::factory(2)->create();
        Booking::factory()->count(20)->create();
    }
}
