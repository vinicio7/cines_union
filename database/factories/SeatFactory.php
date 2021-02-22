<?php

use App\Models\Seat;
use Faker\Generator as Faker;

$factory->define(Seat::class, function (Faker $faker) {
	$seat_number = Str::random(1);
	$number = rand(1,50);
	$seat_number = $seat_number.$number;
    return [
            'room_id'             			=> rand(1,2),
            'seat_number'                 	=> strtoupper($seat_number), 
            'status'             			=> 1,
    ];
});
