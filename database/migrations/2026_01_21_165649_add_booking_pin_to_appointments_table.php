<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('booking_pin')->nullable()->after('license_plate');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('booking_pin');
            });
    }
};
