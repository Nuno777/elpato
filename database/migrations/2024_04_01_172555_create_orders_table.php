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
            $table->unsignedBigInteger('id_drop');
            $table->foreign('id_drop')->references('id')->on('drops');
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
            $table->boolean('need_pickup')->default(false);
            $table->boolean('signature_required')->default(false);
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
