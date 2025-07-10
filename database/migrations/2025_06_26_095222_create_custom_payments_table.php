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
        Schema::create('custom_payments', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('phone');
            $table->string('email');
            $table->string('order_number');
            $table->string('service_type');
            $table->decimal('custom_amount', 10,2)->nullable();
            $table->enum('status', ['Pending', 'Completed', 'Cancelled'])->default('Pending');
            $table->string('ss_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_payments');
    }
};
