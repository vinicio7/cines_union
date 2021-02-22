<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BilboardTable extends Migration
{

    public function up()
    {
        Schema::create('bilboard', function (Blueprint $table) {
            $table->increments('bilboard_id');
            $table->integer('room_id');
            $table->integer('movie_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
            $table->float('price');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bilboard');
    }
}
