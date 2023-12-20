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
        Schema::create('review_dishes', function (Blueprint $table) {
            $table->unsignedBigInteger('dishId');
            $table->unsignedBigInteger('customerId');
            $table->string('description');
            $table->integer('star');
            $table->primary(['dishId', 'customerId']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_dishes');
    }
};
