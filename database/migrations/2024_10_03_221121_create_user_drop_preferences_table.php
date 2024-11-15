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
            $table->id();
            $table->bigInteger('chat_id')->index(); // ID do chat no Telegram
            $table->string('drop_ids'); // IDs das drops seguidas pelo utilizador, separados por vírgulas
            $table->string('username');
            $table->timestamps(); // Criado em e atualizado em
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
