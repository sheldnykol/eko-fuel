<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fuel_orders', function (Blueprint $table) {
            $table->id();

            $table->string('fuel_name');
            $table->string('fuel_phone');
            $table->string('fuel_afm');
            $table->string('fuel_city');
            $table->string('fuel_address');
            $table->string('fuel_number_address')->nullable();

           $table->enum('fuel_type', [
            'diesel_economy',
            'diesel_avio'
]);

            $table->integer('fuel_quantity');

            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuel_orders');
    }
};