<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence();
    return [
        'category_id' => rand(1, 9),
        'title' =>  $title,
        'slug' => \Str::slug($title),
        'body' => $faker->paragraph($nbSentences = 80, $variableNbSentences = true),
        'user_id' => rand(1,2)
    ];
});
