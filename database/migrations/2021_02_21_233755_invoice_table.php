<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvoiceTable extends Migration
{
   
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('invoice_id');
            $table->integer('client_id');
            $table->integer('bilboard_id');
            $table->integer('user_id');
            $table->date('date');
            $table->decimal('total');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
