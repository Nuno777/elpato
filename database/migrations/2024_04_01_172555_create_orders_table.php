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
            $table->string('product')->notnull();
            $table->string('name')->notnull();
            $table->integer('quant')->notnull();
            $table->float('price')->notnull();
            $table->string('tracking')->notnull();
            $table->string('code')->unique();
            $table->string('holder')->notnull();
            $table->string('comments')->notnull();
            $table->string('option')->notnull();
            $table->date('delivery')->notnull();
            $table->string('shop')->notnull();
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
