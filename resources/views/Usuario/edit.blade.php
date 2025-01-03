@extends('layouts.main')

@section('title', 'Usuários')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Editar Usuário</h2>

    <form action="{{ route('editarUsuario', ['id' => $usuario->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario->nome }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}">
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" value="{{ $usuario->senha }}">
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $usuario->telefone }}">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>   
</div>

@endsection('content')