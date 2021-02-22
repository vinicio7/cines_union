<?php

use App\Models\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
            'client_id'             		=> rand(1,2),
            'bilboard_id'                 	=> rand(1,2), 
            'user_id'             			=> rand(1,2),
            'date'                 			=> '2021-02-01', 
            'total'                 		=> 49.90, 
            'status'                 		=> 1, 
    ];
});
