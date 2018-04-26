<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
	public function products(){
		return $this->hasMany('App\Product');
	}
}
