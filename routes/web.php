<?php

use App\Http\Controllers\GaleriaController;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);
Route::get('/descargar-fotos', [GaleriaController::class, 'descargar']);
