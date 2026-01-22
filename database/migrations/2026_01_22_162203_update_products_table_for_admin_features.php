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
        Schema::table('products',function (Blueprint $table) {
            //connect with gus station
            $table->foreignId('station_id')->after('id')->constrained()->onDelete('cascade');

            //add price
            $table->decimal('price', 8, 2)->after('category')->default(0);

            //Adding Type (Services or Product)
            //We use enum for safety instead of String
            $table->enum('product_type', ['service', 'retail'])->after('category')->default('retail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function(Blueprint $table){
            $table->dropForeign(['station_id']);
            $table->dropColumn(['station_id', 'price', 'product_type']);
            
        });
    }
};
