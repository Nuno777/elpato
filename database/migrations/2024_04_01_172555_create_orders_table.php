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
            $table->string('id_drop')->unique();
            $table->string('id_order')->unique();
            $table->string('name')->unique();
            $table->string('address')->unique();
            $table->string('packages');
            $table->string('notes');
            $table->string('status');
            $table->string('type');
            $table->string('expired');
            $table->string('personalnotes');
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
