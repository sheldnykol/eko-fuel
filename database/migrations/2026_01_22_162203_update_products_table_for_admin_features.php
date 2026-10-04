<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products',function (Blueprint $table) {
            $table->foreignId('station_id')->after('id');

            $table->decimal('price', 8, 2)->after('category')->nullable();

            $table->enum('product_type', ['service', 'retail'])->after('category')->default('retail');
        });
    }

    public function down(): void
    {
        Schema::table('products', function(Blueprint $table){
            $table->dropForeign(['station_id']);
            $table->dropColumn(['station_id', 'price', 'product_type']);
        });
    }
};
