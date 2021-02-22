<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CinemaTable extends Migration
{

    public function up()
    {
        Schema::create('cinema', function (Blueprint $table) {
            $table->increments('cinema_id');
            $table->string('name');
            $table->string('logo');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('departament_id');
            $table->integer('municipality_id');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cinema');
    }
}
