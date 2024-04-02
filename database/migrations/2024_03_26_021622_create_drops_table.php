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
            $table->string('id_drop')->unique()->notnull();
            $table->string('name')->notnull();
            $table->string('address')->unique()->notnull();
            $table->string('packages')->notnull();
            $table->string('notes')->notnull();
            $table->string('status')->notnull();
            $table->string('type')->notnull();
            $table->date('expired')->notnull();
            $table->string('personalnotes')->notnull();
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
