@extends('layouts.main')

@section('title', 'Editar Usuário')

@section('content')

<div class="container mt-5">
    <h2 class="mt-4" style="font-size: 1.5rem; font-weight: bold; color:rgb(109, 109, 109); text-align: left;">
        Editar Informações
    </h2>
    <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $usuario->telefone }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Deixe em branco para não alterar">
        </div>




        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection
