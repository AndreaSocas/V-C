<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
	protected $table = 'posts';

	protected $fillable = [
		'nombre',
		'mensaje',
	];

	public function imagenes() : HasMany
	{
		return $this->hasMany(Imagenes::class);
	}
}
