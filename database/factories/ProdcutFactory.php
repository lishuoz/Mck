<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {

	// $users = App\User::all()->pluck('id')->toArray();
	// $teams = App\Team::all()->pluck('id')->toArray();

    return [
    	// 'user_id' => $faker->randomElement($users),
    	// 'team_id' => $faker->randomElement($teams),
        'price' => $faker->randomNumber($nbDigits = 4, $strict = false),
        'description' => $faker->sentence($nbWords = 20, $variableNbWords = true)
    ];
});
