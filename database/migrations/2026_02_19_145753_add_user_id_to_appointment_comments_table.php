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
        Schema::table('appointment_comments', function (Blueprint $table) {
            // Προσθέτουμε το user_id μετά το id και το συνδέουμε με τον πίνακα users
            $table->foreignId('user_id')
                ->after('id') 
                ->constrained()
                ->nullable()
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('appointment_comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
