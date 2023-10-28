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
        Schema::create('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('customerId');
            $table->string('status');
            $table->integer('promotion')->default(0);
            $table->string('payments')->default('cash');
            $table->unsignedBigInteger('nameTable');
            $table->foreign('customerId')->references('customerId')->on('customers');
            $table->primary('customerId');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
