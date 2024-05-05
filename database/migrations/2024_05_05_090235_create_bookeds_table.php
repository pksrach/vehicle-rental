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
        Schema::create('bookeds', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2)->default(0);
            $table->dateTime('pickup_date')->nullable();
            $table->dateTime('complete_date')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('payment_method_id')->nullable();

            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

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
        Schema::dropIfExists('bookeds');
    }
};
