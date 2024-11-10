<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cliente;
use App\Http\Controllers\Livro;

Route::get('/home', function () {
    return view('home');
});

Route::get('/faleconosco', function () {
    return view('faleconosco');
});

Route::get('cadastrarCliente', [Cliente::class, 'create']);
Route::post('cadastrarCliente', [Cliente::class, 'store']);
Route::get('listarCliente', [Cliente::class, 'index']);
Route::delete('deletarCliente/{id}', [Cliente::class, 'destroy']);
Route::get('editarCliente/{id}', [Cliente::class, 'edit']);

Route::get('cadastrarLivro', [Livro::class, 'create']);
Route::post('cadastrarLivro', [Livro::class, 'store']);
Route::get('listarLivro', [Livro::class, 'index']);
Route::delete('deletarLivro/{id}', [Livro::class, 'destroy']);
Route::get('editarLivro/{id}', [Livro::class, 'edit']);