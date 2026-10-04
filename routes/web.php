<?php

use App\Http\Controllers\IphoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IphoneController::class, 'index'])->name('iphones.index');
Route::post('/comprar/{id}', [IphoneController::class, 'comprar'])->name('iphones.comprar');
