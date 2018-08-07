<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Comment::class, function (Faker $faker) {

    $user_id = rand(1,3);
    $time = Carbon\Carbon::now();

    return [
        'content' => $faker->sentence(10),
        'user_id' => $user_id,
        'manga_id' => 1,
        'comment_id' => null,
        'created_at' => $time->toDateTimeString(),
        'updated_at' => $time->toDateTimeString()
    ];
});
