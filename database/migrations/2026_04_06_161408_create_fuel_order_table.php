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
        Schema::create('fuel_orders', function (Blueprint $table) {
            $table->id();


            //customer info
            $table->string('fuel_name');
            $table->string('fuel_phone');
            $table->string('fuel_afm');
            $table->string('fuel_city');
            $table->string('fuel_address');
            $table->string('fuel_number_address')->nullable();

            //Τύποσ Καυσίμου
           $table->enum('fuel_type', [
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
        Schema::dropIfExists('fuel_orders');
    }
};