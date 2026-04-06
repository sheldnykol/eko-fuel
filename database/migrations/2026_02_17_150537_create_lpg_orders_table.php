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
            $table->string('lpg_name');
            $table->string('lpg_phone');
            $table->string('lpg_afm');
            $table->string('lpg_city');
            $table->string('lpg_type');
            $table->string('lpg_address');
            $table->string('lpg_number_address')->nullable();
            
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
