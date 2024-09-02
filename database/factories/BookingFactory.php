<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fuelType = FuelType::inRandomOrder() ->first();
        $transmissionId =  $fuelType->name === 'Electricity' ? Transmission::where('name', 'Automatic')->first()->id : Transmission::inRandomOrder() ->first()->id;

        return [
            'departure' => fake()->dateTimeBetween('+0 days', '+1 years'),
            'return' => fake()->dateTimeBetween('+0 days', '+1 years'),
            'driver_id' => Driver::inRandomOrder() ->first()?->id,
            'vehicle_category_id' => VehicleCategory::inRandomOrder() ->first()?->id,
            'fuel_type_id' => $fuelType->id,
            'transmission_id' => $transmissionId,
            'price_per_day' => 10
        ];
    }
}
