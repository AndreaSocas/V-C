<?php

namespace App\Jobs;

use App\Models\Imagenes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image;

class CreateThumbnailJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $imagenId;

	public function __construct($imagenId)
	{
		$this->imagenId = $imagenId;
	}

	public function handle()
	{
		$imagen = Imagenes::find($this->imagenId);
		if (!$imagen) return;

		$originalPath = storage_path('app/public/' . $imagen->url);

		$thumbPath = str_replace('posts/', 'posts/thumbs/', $imagen->url);
		$thumbFullPath = storage_path('app/public/' . $thumbPath);

		@mkdir(dirname($thumbFullPath), 0777, true);

		Image::load($originalPath)
			->width(1600)
			->quality(75)
			->save($thumbFullPath . '.webp');

		$imagen->thumb_url = $thumbPath . '.webp';
		$imagen->processed = true;
		$imagen->save();
	}
}
