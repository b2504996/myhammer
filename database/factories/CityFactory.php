<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\City::class, function (Faker $faker) {
    return [
        'zip' => rand(10000, 99999),
        'name' => $faker->city
    ];
});
