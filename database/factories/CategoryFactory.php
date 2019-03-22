<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
<<<<<<< HEAD
        //
=======
        'name' => $faker->word,
        'created_at' => now(),
        'updated_at' => $faker->dateTimeBetween('+0 days', '+2 years')
>>>>>>> ba43fe5548a21b38da351833269257e0a7638dfa
    ];
});
