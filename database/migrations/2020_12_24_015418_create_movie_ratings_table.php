<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id')->index()->unique();
            $table->integer('average')->default(0);
            $table->integer('star1')->default(0);
            $table->integer('star2')->default(0);
            $table->integer('star3')->default(0);
            $table->integer('star4')->default(0);
            $table->integer('star5')->default(0);
            $table->timestamps();

            $table->foreign('movie_id')->references('id')->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_ratings');
    }
}
