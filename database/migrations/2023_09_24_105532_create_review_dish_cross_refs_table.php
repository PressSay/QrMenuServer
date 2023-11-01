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
        Schema::create('review_dish_cross_refs', function (Blueprint $table) {
            $table->unsignedBigInteger('reviewId');
            $table->unsignedBigInteger('dishId');
            $table->unsignedBigInteger('customerId');
            $table->primary(['reviewId', 'dishId', 'customerId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_dish_cross_refs');
    }
};
