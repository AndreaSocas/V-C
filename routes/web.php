<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;


Route::post('/idioma', function () {
	session(['locale' => request()->idioma]);
	return redirect()->back();
})->name('idioma');

Route::middleware(['language'])->group(function () {

    Route::get('/', function () {
        return view('home');
    });
});

Route::post('/contacto', [ContactoController::class, 'enviar'])->name('ContactoEnviar');