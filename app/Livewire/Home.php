<?php

namespace App\Livewire;

use App\Models\Imagenes;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
{
	use WithFileUploads;

	public $nombre;
	public $mensaje;
	public $imagenes = [];
	public $imagenesGaleria = [];

	public function mount()
	{
		$this->imagenesGaleria = Imagenes::all();
	}

	public function guardar()
	{
		$post = new Post();

		$post->nombre = $this->nombre;
		$post->mensaje = $this->mensaje;
		$post->save();

		$hora = now()->format('Hi');

		foreach ($this->imagenes as $i => $imagen) {
			$extension = $imagen->getClientOriginalExtension();
			$hash = substr(md5(uniqid()), 0, 4); // 4 caracteres para asegurar unicidad
			$nombreArchivo = "{$this->nombre}_{$hora}_{$i}_{$hash}.{$extension}";
			
			$post->imagenes()->create([
				'url' => $imagen->storeAs('posts', $nombreArchivo, 'public'),
				'nombre' => $nombreArchivo,
			]);
		}

		$this->imagenesGaleria = Imagenes::all();
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
		return view('livewire.home');
	}
}
