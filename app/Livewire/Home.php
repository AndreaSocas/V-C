<?php

namespace App\Livewire;

use App\Jobs\CreateThumbnailJob;
use App\Models\Imagenes;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
{
	use WithFileUploads;

	#[Validate('required', message: 'Indica tu nombre.')]
	public $nombre;
	public $mensaje;
	#[Validate('required', message: 'Sube una foto del momento.')]
	public $imagenes = [];

	protected function rules()
	{
		return [
			'imagenes' => 'required|array|min:1',
			'imagenes.*' => 'file|mimes:jpeg,jpg,png,webp,heic,heif|max:10240',
		];
	}

	public function guardar()
	{
		$this->validate();

		$post = new Post();

		$post->nombre = $this->nombre;
		$post->mensaje = $this->mensaje;
		$post->save();

		$hora = now()->format('Hi');

		foreach ($this->imagenes as $i => $imagen) {
			$nombreLimpio = Str::of($this->nombre)->slug('_');
			$extension = $imagen->getClientOriginalExtension();
			$hash = substr(md5(uniqid()), 0, 4); // 4 caracteres para asegurar unicidad
			$nombreArchivo = "{$nombreLimpio}_{$hora}_{$i}_{$hash}.{$extension}";

			$ruta = $imagen->storeAs('posts', $nombreArchivo, 'public');

			$nuevaImagen = $post->imagenes()->create([
				'url' => $ruta,
				'nombre' => $nombreArchivo,
				'processed' => false,
			]);

			dispatch(new CreateThumbnailJob($nuevaImagen->id));
		}

		$this->nombre = '';
		$this->mensaje = '';
		$this->imagenes = [];
	}

	public function eliminarImagen($index)
	{
		if (isset($this->imagenes[$index])) {
			unset($this->imagenes[$index]);
			$this->imagenes = array_values($this->imagenes);
		}
	}

	public function render()
	{
		return view('livewire.home', [
			'imagenesGaleria' => Imagenes::latest()->get()
		]);
	}
}
