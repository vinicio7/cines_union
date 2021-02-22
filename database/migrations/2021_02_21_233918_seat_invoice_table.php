<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeatInvoiceTable extends Migration
{

    public function up()
    {
        Schema::create('seat_invoice', function (Blueprint $table) {
            $table->increments('seat_invoice_id');
            $table->integer('client_id');
            $table->integer('seat_id');
            $table->integer('invoice_id');
            $table->integer('bilboard_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seat_invoice');
    }
}
