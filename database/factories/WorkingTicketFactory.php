<?php

use Faker\Generator as Faker;

$factory->define(App\WorkingTicket::class, function (Faker $faker) {
    $name = $faker->unique()->word;
    $sentence = $faker->sentence;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'markup' => $sentence,
        'html' => $sentence
    ];
});
