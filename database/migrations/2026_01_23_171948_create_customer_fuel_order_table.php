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
        Schema::create('customer_fuel_order', function (Blueprint $table) {
            $table->id();
            //Connect apointment with gas station (1 or 2)
            $table->integer('station_id');

            //customer info
            $table->string('customer_fuel_name');
            $table->string('customer_fuel_phone');
            $table->string('customer_fuel_afm');
            $table->string('customer_fuel_city');
            $table->string('customer_fuel_address');
            $table->integer('customer_fuel_number_of_address');

            //Τύποσ Καυσίμου
           $table->enum('fuel_type', [
            'unleaded_95',
            'unleaded_100',
            'diesel_economy',
            'diesel_avio'
]);

            //Ποσότητα Καυσίμου
            $table->integer('fuel_quantity');

            

            //Προσθέτω το status(1=Εκρεμεί 2=Ολοκληρώθηκε 3=Ακυρώθηκε)
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
        Schema::dropIfExists('customer_fuel_order');
    }
};
