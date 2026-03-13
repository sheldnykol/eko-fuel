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
        Schema::create('lpg_orders', function (Blueprint $table) {
            $table->id();

            //Customer info 
            $table->string('customer_lpg_name');
            $table->string('customer_lpg_phone');
            $table->string('customer_lpg_afm');
            $table->string('customer_lpg_city');
            $table->string('customer_lpg_address');
            $table->integer('customer_lpg_number_of_address');
            
            //Ποσότητα Υγραερίου
            $table->integer('lpg_quantity');

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
        Schema::dropIfExists('lpg_orders');
    }
};
