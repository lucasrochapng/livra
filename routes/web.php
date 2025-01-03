<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario;
use App\Http\Controllers\Livro;

Route::get('/home', function () {
    return view('home');
});

Route::get('/faleconosco', function () {
    return view('faleconosco');
});

Route::get('cadastrarUsuario', [Usuario::class, 'create']);
Route::post('cadastrarUsuario', [Usuario::class, 'store']);
Route::get('listarUsuario', [Usuario::class, 'index']);
Route::delete('deletarUsuario/{id}', [Usuario::class, 'destroy']);
//Route::get('editarUsuario/{id}', [Usuario::class, 'edit']);
//Route::put('editarUsuario/{id}', [Usuario::class, 'update']);

// Rota para exibir o formulário de edição (GET)
Route::get('editarUsuario/{id}', [Usuario::class, 'edit'])->name('editarUsuario');
// Rota para atualizar os dados do usuário (PUT)
Route::put('editarUsuario/{id}', [Usuario::class, 'update'])->name('editarUsuario');
Route::get('/listarUsuario', [Usuario::class, 'index'])->name('listarUsuario');


Route::get('cadastrarLivro', [Livro::class, 'create']);
Route::post('cadastrarLivro', [Livro::class, 'store']);
Route::get('listarLivro', [Livro::class, 'index']);
Route::delete('deletarLivro/{id}', [Livro::class, 'destroy']);
Route::get('editarLivro/{id}', [Livro::class, 'edit']);