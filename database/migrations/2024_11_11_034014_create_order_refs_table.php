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
        Schema::create('order_refs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user')->notnull();
            $table->string('product')->notnull();
            $table->integer('quant')->notnull();
            $table->float('price')->notnull();
            $table->string('tracking')->notnull();
            $table->string('code')->notnull();
            $table->string('comments')->notnull();
            $table->string('shop')->notnull();
            $table->string('status')->notnull();
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_refs');
    }
};
