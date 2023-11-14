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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('book_summary_id')->nullable();
            $table->string('assigned_employee_id')->nullable();
            $table->string('service_type_id', 20)->nullable();
            $table->string('note', 250)->nullable();
            $table->string('schedule_date', 30)->nullable();
            $table->string('service_time_id', 30)->nullable();
            $table->string('appointment_status', 20)->default('Pending');
            $table->string('payment_status', 20)->default('Unpaid');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
