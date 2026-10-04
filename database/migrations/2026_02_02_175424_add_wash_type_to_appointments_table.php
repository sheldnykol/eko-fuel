<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('wash_type')->after('appointment_time');
            $table->text('comments')->nullable()->after('wash_type');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
        });
    }
};
