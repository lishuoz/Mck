<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->randomElement($array = array ('球衣','球裤','夹克', '长裤', '长短袖射手服/T恤'))
	];
});
