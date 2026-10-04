<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lpg_orders', function (Blueprint $table) {
            $table->id();

            $table->string('lpg_name');
            $table->string('lpg_phone');
            $table->string('lpg_afm');
            $table->string('lpg_city');
            $table->string('lpg_type');
            $table->string('lpg_address');
            $table->string('lpg_number_address')->nullable();
            
            $table->integer('lpg_quantity');

            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lpg_orders');
    }
};