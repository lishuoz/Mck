<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaImage extends Model
{
	protected $fillable = [
		'name', 'thumbnail_path', 'small_path', 'medium_path', 'large_path'
	];
	
	public function product(){
		return $this->belongsTo('App\Product');
	}
}
