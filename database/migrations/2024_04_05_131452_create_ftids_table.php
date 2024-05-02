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
        Schema::create('ftids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user')->notnull();
            $table->string('carrier')->notnull();
            $table->string('tracking')->notnull();
            $table->string('store')->notnull();
            $table->text('label')->notnull(); // Para armazenar o caminho do arquivo PDF ou PNG
            $table->string('status')->notnull()->default('FTID Created');
            $table->string('method')->notnull();
            $table->string('comments')->nullable();
            $table->date('label_creation_date')->notnull();
            $table->date('label_payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ftids', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('ftids');
    }
};
