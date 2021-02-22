<?php



use App\Models\Municipality;
use Faker\Generator as Faker;

$factory->define(Municipality::class, function (Faker $faker) {
    return [
            'departament_id'        => rand(1,2),
            'name'             		=> $this->faker->city(),
            'status'                => 1, 
    ];
});
