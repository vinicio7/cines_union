<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientTable extends Migration
{

    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->increments('client_id');
            $table->string('name');
            $table->string('direction');
            $table->string('tax');
            $table->string('name_tax');
            $table->string('phone');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client');
    }
}
