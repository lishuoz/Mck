<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchImage extends Model
{
	protected $fillable = [
		'path', 'thumbnail_path'
	];
}
