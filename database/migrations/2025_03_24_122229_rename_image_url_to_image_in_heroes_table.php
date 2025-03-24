<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameImageUrlToImageInHeroesTable extends Migration
{
    public function up(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->renameColumn('image_url', 'image');
        });
    }

    public function down(): void
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->renameColumn('image', 'image_url');
        });
    }
}