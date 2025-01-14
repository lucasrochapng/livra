<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AcervoController;

Route::get('/home', function () {
    return view('home');
});

Route::get('/faleconosco', function () {
    return view('faleconosco');
});

// Rota para autenticação ---------------------------------------------------------------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function(){
        return view('dashboard');
    });
});

// Rotas adicionais
Route::get('/suporte', function () {
    return view('suporte');
});
Route::get('/sobre', function () {
    return view('sobre');
});
Route::get('/configuracoes', function () {
    return view('configuracoes');
})->middleware('auth'); // Apenas usuários logados podem acessar

Route::get('cadastrarUsuario', [Usuario::class, 'create']);
Route::post('cadastrarUsuario', [Usuario::class, 'store']);
Route::get('listarUsuario', [Usuario::class, 'index']);
Route::delete('deletarUsuario/{id}', [Usuario::class, 'destroy']);

// Rota para exibir o formulário de edição (GET)
Route::get('editarUsuario/{id}', [Usuario::class, 'edit'])->name('editarUsuario');
// Rota para atualizar os dados do usuário (PUT)
Route::put('editarUsuario/{id}', [Usuario::class, 'update'])->name('editarUsuario');
Route::get('/listarUsuario', [Usuario::class, 'index'])->name('listarUsuario');

// Rotas para Coleção (CRUD livro) ----------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/livros', [LivroController::class, 'index'])->name('listarLivro');
    Route::get('/livros/create', [LivroController::class, 'create'])->name('criarLivro');
    Route::post('/livros', [LivroController::class, 'store'])->name('salvarLivro');
    Route::get('/livros/{id}/edit', [LivroController::class, 'edit'])->name('editarLivro');
    Route::post('/livros/{id}/update', [LivroController::class, 'update'])->name('atualizarLivro');
    Route::get('/livros/{id}/delete', [LivroController::class, 'destroy'])->name('deletarLivro');
    Route::get('/livros/{id}/toggleStatus', [LivroController::class, 'toggleStatus'])->name('alterarEstadoLivro');
});

// Rotas para Acervo ----------------------------------------------------------------------------------

Route::middleware(['auth'])->group(function () {
    Route::get('/acervo', [AcervoController::class, 'acervo'])->name('acervo');
    Route::post('/oferecerTroca', [TrocaController::class, 'oferecerTroca'])->name('oferecerTroca');

});

Route::get('/livro/alterar-estado/{id}', [LivroController::class, 'alterarEstado'])->name('alterarEstadoLivro');

