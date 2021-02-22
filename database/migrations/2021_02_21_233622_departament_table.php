<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepartamentTable extends Migration
{

    public function up()
    {
        Schema::create('departament', function (Blueprint $table) {
            $table->increments('departament_id');
            $table->string('name');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departament');
    }
}
