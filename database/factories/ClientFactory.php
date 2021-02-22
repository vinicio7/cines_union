<?php

use App\Models\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    $name = $this->faker->name();
    return [
            'name'             		=> $name,
            'direction'             => $this->faker->address(),
            'tax'             		=> 'CF', 
            'name_tax'              => $name, 
            'phone'              	=> $this->faker->phoneNumber, 
            'status'                => 1, 
    ];
});
