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
        Schema::create('user_drop_preferences', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->bigInteger('chat_id')->index();
            $table->string('drop_ids');
            $table->string('username');
            $table->string('telegram');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_drop_preferences');
    }
};
