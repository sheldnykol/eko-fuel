<?php

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
        Schema::create('heating_oil_orders', function (Blueprint $table) {
            $table->id();
            //Customer info 
            $table->string('heatOil_name');
            $table->string('heatOil_phone');
            $table->string('heatOil_afm');
            $table->string('heatOil_city');
            $table->string('heatOil_address');
            $table->string('heatOil_number_address')->nullable();

             //Ποσότητα Πετρελαίου Θέρμανσης
            $table->integer('heatOil_quantity');
            
            $table->integer('status')->default(1);
            //creates created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heating_oil_orders');
    }
};