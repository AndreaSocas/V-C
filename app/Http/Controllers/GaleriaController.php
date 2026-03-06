<?php

namespace App\Http\Controllers;

use App\Models\Post;
use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GaleriaController extends Controller
{
	public function descargar(Request $request)
	{
		if (
			$request->getUser() !== config('app.fotos_user') ||
			$request->getPassword() !== config('app.fotos_password')
		) {

			return response('Unauthorized', 401)
				->header('WWW-Authenticate', 'Basic realm="Descarga de fotos"');
		}

		return $this->generarZip();
	}

	private function generarZip()
	{
		$zipFile = storage_path('app/fotos_maria&felipe.zip');

		$zip = new ZipArchive;
		$zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

		$posts = Post::with('imagenes')->get();

		foreach ($posts as $post) {

			$folder = Str::slug($post->nombre) . '_' . $post->created_at->format('Y-m-d_H-i');

			foreach ($post->imagenes as $imagen) {

				$path = storage_path('app/public/' . $imagen->url);

				if (file_exists($path)) {
					$zip->addFile($path, $folder . '/' . $imagen->nombre);
				}
			}

			if ($post->mensaje) {

				$contenido = "Nombre: {$post->nombre}\n\n";
				$contenido .= "Mensaje:\n{$post->mensaje}\n";

				$zip->addFromString($folder . '/mensaje.txt', $contenido);
			}
		}

		$zip->close();

		return response()->download($zipFile)->deleteFileAfterSend(true);
	}
}
