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
        Schema::create('watch_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('episode_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('watch_time')->default(0); // Time watched in seconds
            $table->boolean('completed')->default(false); // Whether the episode/movie was completed
            $table->timestamps();

            // Index for faster queries
            $table->index(['user_id', 'movie_id']);
            $table->index(['user_id', 'episode_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('watch_history');
    }
};