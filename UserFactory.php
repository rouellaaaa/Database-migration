<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'address' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt($faker->password),
        'user_type_id' => mt_rand(1, 5)
    ];
});
