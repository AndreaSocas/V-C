<?php

namespace App\Livewire;

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
	#[Validate('required', message: 'Deja un mensaje para los novios.')]
	public $mensaje;
	#[Validate('required', message: 'Sube una foto del momento.')]
	public $imagenes = [];
	public $imagenesGaleria = [];

	public function mount()
	{
		$this->imagenesGaleria = Imagenes::all();
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
			
			$post->imagenes()->create([
				'url' => $imagen->storeAs('posts', $nombreArchivo, 'public'),
				'nombre' => $nombreArchivo,
			]);
		}

		$this->nombre = '';
		$this->mensaje = '';
		$this->imagenes = [];

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
