<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            //Προσθέτουμε το status (1=Εκκρεμεί, 2=Ολοκληρώθηκε, 3=Ακυρώθηκε)
            // $table->integer('status')->default(1);
            // $table->string('booking_pin')->after('status');
            $table->string('booking_pin')->nullable()->after('license_plate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
                // Καλό είναι στο down να ορίζουμε την αφαίρεση σε περίπτωση rollback
                $table->dropColumn('booking_pin');
            });
    }
};
