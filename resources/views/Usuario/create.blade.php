@extends('layouts.main')

@section('title', 'Usuários')

@section('content')

<form action="cadastrarUsuario" method="post" class="container mt-5">
    @csrf
    <div class="alert alert-info" role="alert">
        {{ session('mensagem') }}
    </div>

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" id="nome" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" required>
    </div>

    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" name="senha" class="form-control" id="senha" required>
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" id="telefone">
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<div class="mt-3">
    <a href="{{ url('/listarUsuario') }}" class="btn btn-secondary">Listar Usuários</a>
</div>

@endsection