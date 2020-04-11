<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    $title = rtrim($faker->sentence(rand(5, 10)), ".");
    return [
        'title' => $title,
        'body' => $faker->paragraph(rand(3, 7), true),
        'views' => rand(0, 10),
        'answers' => rand(0, 10),
        'votes' => rand(-3, 10),
        'slug' => \Illuminate\Support\Str::slug($title)

    ];
});
