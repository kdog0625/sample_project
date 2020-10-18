<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tweet;
use Faker\Generator as Faker;

$factory->define(Tweet::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'title' => $faker->realText(50),
        'email' => $faker->unique()->email,
        'url' => $faker->url,
        'gender' => $faker->randomElement(['0','1']),
        'age' => $faker->numberBetween($min=1,$max=60),
        'contact' => $faker->realText(200),
    ];
});
