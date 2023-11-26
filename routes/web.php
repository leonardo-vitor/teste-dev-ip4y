<?php

use App\Http\Controllers\Project\PageController;
use App\Http\Controllers\Project\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', [RegisterController::class, 'index'])->name('register.list');

Route::get('/novo-registro', [RegisterController::class, 'create'])->name('register.create');
Route::post('/store', [RegisterController::class, 'store'])->name('register.store');

Route::get('/editar-registro/{register}', [RegisterController::class, 'edit'])->name('register.edit');
Route::match(['PUT', 'PATCH'], '/update/{register}', [RegisterController::class, 'update'])->name('register.update');

Route::delete('/excluir/{register}', [RegisterController::class, 'destroy'])->name('register.destroy');

Route::get('/json', [RegisterController::class, 'sendData'])->name('register.sendAll');
Route::get('/json/{register}', [RegisterController::class, 'sendData'])->name('register.send');
