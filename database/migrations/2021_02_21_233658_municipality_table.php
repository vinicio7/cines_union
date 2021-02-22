<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MunicipalityTable extends Migration
{

    public function up()
    {
        Schema::create('municipality', function (Blueprint $table) {
            $table->increments('municipality_id');
            $table->integer('departament_id');
            $table->string('name');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipality');
    }
}
