<?php


use App\Models\Cinema;
use Faker\Generator as Faker;

$factory->define(Cinema::class, function (Faker $faker) {
    $name = $this->faker->name();
    return [
            'name'                  => $name,
            'adress'                => $this->faker->streetAddress(),
            'phone'                 => $this->faker->phoneNumber(),
            'logo'                  => 'https://www.launion.com.gt/wp-content/uploads/2020/08/Logo-zafra-52-02-02_020b006e0_4327@2x.jpg',
            'latitude'              => $this->faker->latitude(14, 15), 
            'longitude'             => $this->faker->longitude(-89, -90),
            'departament_id'        => rand(1,2), 
            'municipality_id'       => rand(1,2),
            'status'                => 1, 
    ];
});









