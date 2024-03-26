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
        Schema::create('drops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('packages');
            $table->string('notes');
            $table->string('status');
            $table->string('type');
            $table->string('expired');
            $table->string('personal_notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drops');
    }
};
