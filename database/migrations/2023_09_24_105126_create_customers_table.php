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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customerId');
            $table->unsignedBigInteger('userId');
            $table->date('dateExpireCode');
            $table->string('name');
            $table->text('code');
            $table->string('phoneNumber');
            $table->text('address')->nullable();
            $table->foreign('userId')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('tableOrder', function (Blueprint $table) {
            $table->id('nameTable');
            $table->string('status');
        });


        Schema::create('investment', function (Blueprint $table) {
            $table->string('name');
            $table->decimal('cost', 9, 3);
            $table->primary('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};