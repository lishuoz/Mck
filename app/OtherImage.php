<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherImage extends Model
{
	protected $fillable = [
		'name', 'thumbnail_path', 'small_path', 'medium_path', 'large_path'
	];
}
