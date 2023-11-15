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
        Schema::create('estimators', function (Blueprint $table) {
            $table->id();
            $table->string('car_type', 50)->nullable();
            $table->string('service', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('price', 50)->nullable();
            $table->string('inclusions', 100)->nullable();
            $table->string('quantity', 100)->nullable();
            $table->binary('img')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimators');
    }
};
