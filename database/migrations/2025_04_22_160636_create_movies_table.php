<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('trailer')->nullable();
            $table->enum('type', ['single', 'series'])->default('single');
            $table->date('release_date')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('resolution')->nullable();
            $table->string('language')->nullable();
            $table->string('quality')->nullable(); // HD, 4K, etc.
            $table->decimal('rating', 3, 1)->nullable(); // For average rating
            $table->decimal('imdb_rating', 3, 1)->nullable(); // For IMDB rating
            $table->integer('views')->default(0); // For view count
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
};
