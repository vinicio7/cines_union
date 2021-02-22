<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeatTable extends Migration
{

    public function up()
    {
        Schema::create('seat', function (Blueprint $table) {
            $table->increments('seat_id');
            $table->integer('room_id');
            $table->string('seat_number');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('seat');
    }
}
