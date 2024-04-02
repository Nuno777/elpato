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
            $table->id();
            $table->string('product');
            $table->string('name');
            $table->integer('quant');
            $table->float('price');
            $table->string('tracking');
            $table->string('code');
            $table->string('holder');
            $table->string('comments');
            $table->string('option');
            $table->date('delivery');
            $table->string('shop');
            $table->timestamps();
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
