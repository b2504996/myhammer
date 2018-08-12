<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ExecutionDate::class, function (Faker $faker) {
    return [
        'title' => \Illuminate\Support\Str::random(8)
    ];
});
