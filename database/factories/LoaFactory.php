<?php

use Faker\Generator as Faker;

$factory->define(App\Loa::class, function (Faker $faker) {
	return [
		'name' => $faker->unique()->randomElement($array = array ('不含证书', '联盟证书', '球队证书', '球员证书', 'MGG渠道证书'))

	];
});
