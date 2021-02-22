<?php

use App\Models\CinemaRoom;
use Faker\Generator as Faker;

$factory->define(CinemaRoom::class, function (Faker $faker) {
	$name_room = 'Sala '. rand(1,10);
    return [
            'cinema_id'             => rand(1,2),
            'seat'                  => rand(25,50),
            'name_room'             => $this->faker->secondaryAddress(), 
            'status'                => 1, 
    ];
});
