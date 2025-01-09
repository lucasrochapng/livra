@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="container">
    <h1 class="mt-4">Editar Livro</h1>

    @if (session('mensagem'))
        <div class="alert alert-info">{{ session('mensagem') }}</div>
    @endif

    <form action="{{ route('atualizarLivro', $livro->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do Livro</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $livro->titulo }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" required>{{ $livro->descricao }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto_livro" class="form-label">Atualizar Foto do Livro (opcional)</label>
            <input type="file" class="form-control" id="foto_livro" name="foto_livro">
            @if ($livro->foto_livro)
                <p class="mt-2">Foto Atual:</p>
                <img src="{{ asset('storage/' . $livro->foto_livro) }}" alt="Foto do Livro" class="img-thumbnail" style="max-width: 150px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
@endsection
