<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherImage extends Model
{
	protected $fillable = [
		'path', 'thumbnail_path'
	];
}
