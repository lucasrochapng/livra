<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cliente;

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