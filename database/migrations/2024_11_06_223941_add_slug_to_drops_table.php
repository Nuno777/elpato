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
        Schema::table('drops', function (Blueprint $table) {
            if (!Schema::hasColumn('drops', 'slug')) {
                $table->string('slug')->unique()->after('id_drop');
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('drops', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
