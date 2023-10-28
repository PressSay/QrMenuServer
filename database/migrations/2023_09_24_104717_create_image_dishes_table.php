<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('image_dishes', function (Blueprint $table) {
            $table->unsignedBigInteger('dishId');
            $table->unsignedBigInteger('imageId');
            $table->primary(['dishId', 'imageId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_dishes');
    }
};