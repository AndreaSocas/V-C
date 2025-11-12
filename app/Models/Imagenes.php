<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imagenes extends Model
{
	protected $table = 'imagenes';

	protected $fillable = [
		'post_id',
		'nombre',
		'url',
	];
	
	public function post() : BelongsTo
	{
		return $this->belongsTo(Post::class);
	}
}
