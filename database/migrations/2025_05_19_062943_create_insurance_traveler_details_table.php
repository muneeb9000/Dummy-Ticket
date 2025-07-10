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
        Schema::create('insurance_traveler_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_insurance_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('is_us_citizen')->default(false);
            $table->integer('age');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('citizen_ship');
            $table->string('passport_number')->nullable();
            $table->string('country');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->string('postal_code');
            $table->string('phone_no');
            $table->string('beneficiary_name');
            $table->string('beneficiary_relationship');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_traveler_details');
    }
};
