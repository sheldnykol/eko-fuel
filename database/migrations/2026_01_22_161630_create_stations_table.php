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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name'); // π.χ. ΕΚΟ ΒΟΛΟΥ 12
            $table->string('address')->nullable();
            $table->string('city')->default('Λάρισα');
        });

        DB::table('stations')->insert([
            ['name' => 'ΕΚΟ ΒΟΛΟΥ 12', 'address' => 'Βόλου 12', 'created_at' => now()],
            ['name' => 'ΕΚΟ Κ. ΚΑΡΑΜΑΝΛΗ', 'address' => 'Κ. Καραμανλή', 'created_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
