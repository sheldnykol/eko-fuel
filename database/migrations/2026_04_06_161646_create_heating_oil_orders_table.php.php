<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('heating_oil_orders', function (Blueprint $table) {
            $table->id();
            $table->string('heatOil_name');
            $table->string('heatOil_phone');
            $table->string('heatOil_afm');
            $table->string('heatOil_city');
            $table->string('heatOil_address');
            $table->string('heatOil_number_address')->nullable();

            $table->integer('heatOil_quantity');
            
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heating_oil_orders');
    }
};