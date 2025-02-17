<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('drop_id')->notnull();
            $table->uuid('user_id')->notnull();
            $table->string('message')->notnull();
            $table->string('response')->nullable();
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('drop_id')->references('uuid')->on('drops')->onDelete('cascade');
            $table->foreign('user_id')->references('uuid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
