<?php


use App\Models\Bilboard;
use Faker\Generator as Faker;

$factory->define(Bilboard::class, function (Faker $faker) {
    return [
            'cinema_id'             => rand(1,5),
            'room_id'               => rand(1,2),
            'movie_id'              => rand(1,5),
            'start_time'            => '16:00', 
            'end_time'             	=> '17:30',
            'date'        			=> '2021-02-22', 
            'price'       			=> 49.90,
            'status'                => 1, 
    ];
});
