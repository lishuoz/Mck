<?php

use Faker\Generator as Faker;

$factory->define(App\Player::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->randomElement($array = array ('姚明', '麦迪', '奥尼尔', '保罗', '科比'))
	];
});
