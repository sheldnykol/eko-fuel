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
        Schema::create('_heating_oil_orders', function (Blueprint $table) {
            $table->id();
            //Customer info 
            $table->string('customer_heatingOil_name');
            $table->string('customer_heatingOil_phone');
            $table->string('customer_heatingOil_afm');
            $table->string('customer_heatingOil_city');
            $table->string('customer_heatingOil_address');
            $table->integer('customer_heatingOil_number_of_address');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_heating_oil_orders');
    }
};
