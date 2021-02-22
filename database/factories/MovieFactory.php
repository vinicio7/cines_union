<?php

use App\Models\Movie;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    return [
            'title'             			=> $this->faker->streetName(),
            'duration'                 		=> '01:30:00', 
            'gender'             			=> rand(1,3),
            'rating'                 		=> rand(1,3), 
            'format'                 		=> rand(1,3), 
            'image'                 		=> 'https://static.cinepolis.com/img/peliculas/35929/1/1/35929.jpg', 
            'language'                 		=> rand(1,3), 
            'status'                 		=> 1, 
    ];
});
