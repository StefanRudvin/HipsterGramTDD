<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Post::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'content' => $faker->realText($maxNbChars = 1000, $indexSize = 2),
        'title' => $faker->unique()->realText($maxNbChars = 40, $indexSize = 2),
        'user_id' => App\User::all()->random()->id,
        'image' => "defaults/default".rand(1,6).".jpg"
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'content' => $faker->realText($maxNbChars = 100, $indexSize = 2),
        'user_id' => App\User::all()->random()->id,
        'post_id' => App\Post::all()->random()->id,
    ];
});

