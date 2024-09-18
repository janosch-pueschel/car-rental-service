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

        Driver::factory(40)->create();
        VehicleCategory::factory(7)->create();
        FuelType::factory(3)->create();
        Transmission::factory(2)->create();
        Booking::factory()->count(50)->create();
    }
}
