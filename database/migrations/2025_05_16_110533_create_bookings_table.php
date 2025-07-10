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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->integer('no_of_travelers');
            $table->string('interview_documents')->nullable();
            $table->date('future_delivery_date')->nullable();
            $table->string('referral_source')->nullable();
            $table->boolean('flight_reservation')->default(false);
            $table->boolean('hotel_booking')->default(false);
            $table->boolean('travel_insurance')->default(false);
            $table->boolean('travel_guide')->default(false);
            $table->integer('urgent_reservation')->nullable();
            $table->decimal('total_price', 10,2)->nullable();
            $table->string('discount')->nullable();
            $table->enum('status', ['Pending','Completed','Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
