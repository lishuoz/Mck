<?php

use Faker\Generator as Faker;

$factory->define(App\Level::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->randomElement($array = array ('比赛使用 - 已图片匹配 （Photomatched GU）', '比赛使用（GU）', '比赛使用/备用（GU/GI）', '比赛/球队/工厂使用（GI/TI/FI）', '市售（PC）'))

	];
});
