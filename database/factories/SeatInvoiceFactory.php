<?php

use App\Models\SeatInvoice;
use Faker\Generator as Faker;

$factory->define(SeatInvoice::class, function (Faker $faker) {
    return [
            'client_id'             	=> rand(1,2),
            'seat_id'                 	=> rand(1,2), 
            'invoice_id'             	=> rand(1,2),
            'bilboard_id'				=> rand(1,2)
    ];
});
