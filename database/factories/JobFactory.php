<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Job::class, function (Faker $faker) {
    return [
        'city_id' => function () {
            return factory(\App\Models\City::class)->create()->id;
        },
        'title' => $faker->jobTitle,
        'category_id' => function () {
            return factory(\App\Models\Category::class)->create()->id;
        },
        'description' => $faker->sentences(3),
        'execution_date_id' => function () {
            return factory(\App\Models\ExecutionDate::class)->create()->id;
        },
    ];
});
