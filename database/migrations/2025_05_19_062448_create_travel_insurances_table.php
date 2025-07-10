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
        Schema::create('travel_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('no_of_travelers');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('travelling_from');
            $table->string('travelling_to');
            $table->string('insurance_purpose');
            $table->decimal('price', 10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_insurances');
    }
};
