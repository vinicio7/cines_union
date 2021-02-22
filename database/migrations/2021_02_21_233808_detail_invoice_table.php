<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailInvoiceTable extends Migration
{

    public function up()
    {
        Schema::create('detail_invoice', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->integer('invoice_id');
            $table->integer('quantity_seat');
            $table->decimal('price_seat');
            $table->decimal('subtotal');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_invoice');
    }
}
