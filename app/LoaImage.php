<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaImage extends Model
{
	protected $fillable = [
		'path', 'thumbnail_path'
	];
	
	public function product(){
		return $this->belongsTo('App\Product');
	}
}
