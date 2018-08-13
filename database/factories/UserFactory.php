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
        'parent_comment' => null,
        'created_at' => $time->toDateTimeString(),
        'updated_at' => $time->toDateTimeString()
    ];
});

$factory->define(App\Models\User::class, function (Faker $faker) {

    $time = Carbon\Carbon::now();
    $gender = ["MALE","FEMALE"];
    $state = ["ACTIVE","INACTIVE"];
    $banned = ["T","F"];
    return [
        'f_name' => $faker->firstName,
        'l_name' => $faker->lastName,
        'email' => $faker->email,
        'gender' => array_random($gender),
        'birth_date' => $faker->dateTimeBetween('1990-01-01','1999-01-01','Asia/Ho_Chi_Minh'),
        'phone' => $faker->tollFreePhoneNumber,
        'address' => $faker->address,
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
        'avatar' => 'default.png',
        'state' => array_random($state),
        'banned' => array_random($banned),
        'created_at' => $faker->dateTimeBetween('2015-01-01','2018-01-01','Asia/Ho_Chi_Minh'),
        'updated_at' => $time->toDateTimeString()
    ];
});

$factory->define(App\Models\Admin::class, function (Faker $faker) {

    $time = Carbon\Carbon::now();
    $gender = ["MALE","FEMALE"];
    $state = ["ACTIVE","INACTIVE"];
    $banned = ["T","F"];
    return [
        'f_name' => $faker->firstName,
        'l_name' => $faker->lastName,
        'email' => $faker->email,
        'gender' => array_random($gender),
        'birth_date' => $faker->dateTimeBetween('1990-01-01','1999-01-01','Asia/Ho_Chi_Minh'),
        'phone' => $faker->tollFreePhoneNumber,
        'address' => $faker->address,
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
        'avatar' => 'default.png',
        'state' => array_random($state),
        'banned' => array_random($banned),
        'created_at' => $faker->dateTimeBetween('2015-01-01','2018-01-01','Asia/Ho_Chi_Minh'),
        'updated_at' => $time->toDateTimeString()
    ];
});
