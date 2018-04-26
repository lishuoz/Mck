<?php

use Faker\Generator as Faker;

$factory->define(App\Season::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()
		->randomElement($array = array ('1999-00','约2000年代', '2000-01','2001-02', '2009-10'))
	];
});
