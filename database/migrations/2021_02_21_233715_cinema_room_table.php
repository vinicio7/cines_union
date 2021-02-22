<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CinemaRoomTable extends Migration
{

    public function up()
    {
        Schema::create('cinema_room', function (Blueprint $table) {
            $table->increments('room_id');
            $table->integer('cinema_id');
            $table->integer('seat');
            $table->string('name_room');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }


    public function down()
    {
       Schema::dropIfExists('cinema_room');
    }
}
