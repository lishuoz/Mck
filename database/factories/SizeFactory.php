<?php

use Faker\Generator as Faker;

$factory->define(App\Size::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->randomElement($array = array ('56', '58', '60', 'XL', '2XL'))
	];
});
