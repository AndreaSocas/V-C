<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;


Route::post('/idioma', function () {
	session(['locale' => request()->idioma]);
	return redirect()->back();
})->name('idioma');

Route::middleware(['language'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/contacto', function () {
        return view('contacto');
    })->name('contacto');

    /* ---------- Textos legales ---------- */

    Route::get('/privacidad', function () {
		return view('TextosLegales.privacidad');
	})->name('privacidad');

	Route::get('/avisoLegal', function () {
		return view('TextosLegales.avisoLegal');
	})->name('avisoLegal');

	Route::get('/cookies', function () {
		return view('TextosLegales.cookies');
	})->name('cookies');

	Route::get('/creditos', function () {
		return view('TextosLegales.creditos');
	})->name('creditos');

});

Route::post('/contacto', [ContactoController::class, 'enviar'])->name('ContactoEnviar');