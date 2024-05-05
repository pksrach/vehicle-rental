<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('booked_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booked_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->decimal('service_price', 10, 2)->default(0);
            $table->integer('discount')->default(0);

            $table->foreign('booked_id')->references('id')->on('booked')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_details');
    }
};
