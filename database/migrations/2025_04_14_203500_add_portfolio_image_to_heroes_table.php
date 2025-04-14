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
        Schema::table('heroes', function (Blueprint $table) {
            $table->string('portfolio_image')->nullable(); // allows null if not set yet
        });
    }
    
    public function down()
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->dropColumn('portfolio_image');
        });
    }
    
};
