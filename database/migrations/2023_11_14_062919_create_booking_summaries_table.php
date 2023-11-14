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
        Schema::create('booking_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 11)->nullable();
            $table->string('car_id', 11)->nullable();
            $table->string('appointment_id', 11)->nullable();
            $table->string('products', 1000)->nullable();
            $table->string('quantity', 11)->nullable();
            $table->string('price', 300)->nullable();
            $table->string('total', 250)->nullable(); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_summaries');
    }
};
