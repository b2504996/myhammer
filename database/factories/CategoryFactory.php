<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => \Illuminate\Support\Str::random(8),
    ];
});
