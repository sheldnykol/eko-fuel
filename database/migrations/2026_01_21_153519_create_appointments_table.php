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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            //connect appointment with gus station (1 or 2)
            $table->integer('station_id');

            //customer info
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('license_plate');

            //appointment info
            $table->date('appointment_date');
            $table->date('appointment_time');

            // Προσθέτουμε το status (0=Εκκρεμεί, 1=Ολοκληρώθηκε, 2=Ακυρώθηκε)
            $table->integer('status')->default(1);

            

            $table->timestamps();//creates created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
