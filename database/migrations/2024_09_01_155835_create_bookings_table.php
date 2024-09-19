<?php

use App\Models\Driver;
use App\Models\FuelType;
use App\Models\Transmission;
use App\Models\VehicleCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('departure');
            $table->dateTime('return');
            $table->smallInteger('total_days');
            $table->foreignIdFor(Driver::class)->constrained();
            $table->foreignIdFor(VehicleCategory::class)->constrained();
            $table->foreignIdFor(FuelType::class)->constrained();
            $table->foreignIdFor(Transmission::class)->constrained();
            $table->smallInteger('price_per_day');
            $table->smallInteger('price_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
