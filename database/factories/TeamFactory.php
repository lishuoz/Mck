<?php

use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->randomElement($array = array ('老鹰', '凯尔特人', '篮网', '山猫/新黄蜂', '公牛'))
	];
});
