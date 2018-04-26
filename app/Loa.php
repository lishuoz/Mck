<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loa extends Model
{
	public function products(){
		return $this->belongsToMany('App\Product');
	}
}
