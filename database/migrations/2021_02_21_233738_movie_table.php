<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MovieTable extends Migration
{
    
    public function up()
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->increments('movie_id');
            $table->string('title');
            $table->time('duration');
            $table->tinyInteger('gender');
            $table->string('rating');
            $table->tinyInteger('format');
            $table->string('image');
            $table->tinyInteger('language');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movie');
    }
}
