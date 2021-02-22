<?php

use App\Models\DetailInvoice;
use Faker\Generator as Faker;

$factory->define(DetailInvoice::class, function (Faker $faker) {
    return [
            'invoice_id'             		=> rand(1,2),
            'quantity_seat'                 => 1, 
            'price_seat'             		=> 49.90,
            'subtotal'                 		=> 49.90, 
            'status'                 		=> 1, 
    ];
});
