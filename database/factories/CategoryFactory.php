<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'created_at' => now(),
        'updated_at' => $faker->dateTimeBetween('+0 days', '+2 years')
    ];
});
