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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('id_drop')->notnull();
            $table->string('user')->notnull();
            $table->string('product')->notnull();
            $table->string('name')->notnull();
            $table->string('address')->notnull();
            $table->integer('quant')->notnull();
            $table->float('price')->notnull();
            $table->string('tracking')->notnull();
            $table->string('code')->notnull();
            $table->string('holder')->notnull();
            $table->string('comments')->notnull();
            $table->string('personalnotes')->notnull();
            $table->string('option')->notnull();
            $table->date('delivery')->notnull();
            $table->string('shop')->notnull();
            $table->boolean('pickup')->default(false);
            $table->boolean('signature')->default(false);
            $table->string('status')->notnull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('orders');
    }
};
