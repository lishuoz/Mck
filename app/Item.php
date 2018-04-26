<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function products(){
    	return $this->belongsToMany('App\Product');
    }
}
