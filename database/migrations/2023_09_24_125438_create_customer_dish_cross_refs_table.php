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
        Schema::create('customer_dish_cross_refs', function (Blueprint $table) {
            $table->unsignedBigInteger('customerId');
            $table->unsignedBigInteger('dishId');
            $table->integer('amount');
            $table->primary(['customerId', 'dishId']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_dish_cross_refs');
    }
};
