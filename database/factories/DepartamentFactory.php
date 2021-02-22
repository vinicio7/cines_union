<?php

use App\Models\Departament;
use Faker\Generator as Faker;

$factory->define(Departament::class, function (Faker $faker) {
    return [
            'name'             		=> $this->faker->state(),
            'status'                => 1, 
    ];
});
