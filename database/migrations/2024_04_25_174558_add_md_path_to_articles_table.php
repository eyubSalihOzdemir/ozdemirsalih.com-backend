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
        Schema::dropIfExists('articles'); // Delete the existing table
        

        Schema::table('articles', function (Blueprint $table) {
            Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body_md_filepath');
            $table->string('category_id')->nullable();
            $table->text('description');
            $table->text('thumbnail');
            $table->timestamps();
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
};
