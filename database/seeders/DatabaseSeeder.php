<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\User;
use App\Models\UserRole;
use App\Models\VehicleCategory;
use Illuminate\Container\Attributes\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (!UserRole::exists()) {
            $userRoles = [
                ['name' => 'admin'], ['name' => 'employee']
            ];
    
            FacadesDB::table('user_roles')->insert($userRoles);

            User::create([
                'username' => 'admin',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'password' => bcrypt('password'),
                'user_role_id' => 1]);
        }

        if(!VehicleCategory::exists()) {
            $vehicleCategories = [
                ['name' => 'Mini', 'price_per_day' => 20],
                ['name' => 'Economy', 'price_per_day' => 25],
                ['name' => 'Compact', 'price_per_day' => 30],
                ['name' => 'Intermediate', 'price_per_day' => 35], 
                ['name' => 'Standard', 'price_per_day' => 40],
                ['name' => 'Fullsize', 'price_per_day' => 45],
                ['name' => 'Premium', 'price_per_day' => 50],
            ];

            FacadesDB::table('vehicle_categories')->insert($vehicleCategories);
        }

        if(!FuelType::exists()) {
            $fuelTypes = [
                ['name' => 'Gasoline', 'price_per_day' => 0],
                ['name' => 'Diesel', 'price_per_day' => 10],
                ['name' => 'Electricity', 'price_per_day' => 15],
            ];

            FacadesDB::table('fuel_types')->insert($fuelTypes);
        }

        if(!Transmission::exists()) {
            $transmissions = [
                ['name' => 'Manual', 'price_per_day' => 0],
                ['name' => 'Automatic', 'price_per_day' => 5],
            ];

            FacadesDB::table('transmissions')->insert($transmissions);
        }

        Driver::factory(40)->create();
        Booking::factory()->count(50)->create();
    }
}
