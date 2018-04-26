<?php

use App\Edition;
use Faker\Generator as Faker;

$factory->define(App\Edition::class, function (Faker $faker) {
	$editons = array ('主场', '客场', '第二客场/主场', '复古', '特别场次款（新年，圣帕，欧洲赛，老兵节）');
	foreach ($editons as $editon) {
		Edition::create([
			'name' => $editon,
		]);
	};
		// 'name' => $faker->unique()->randomElement($array = array ('主场', '客场', '第二客场/主场', '复古', '特别场次款（新年，圣帕，欧洲赛，老兵节）'))

});
