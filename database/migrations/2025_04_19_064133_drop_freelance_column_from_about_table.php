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
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn('freelance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('about', function (Blueprint $table) {
            $table->boolean('freelance')->default(true);
        });
    }
};