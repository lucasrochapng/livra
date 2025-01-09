@extends('layouts.main')

@section('title', 'Registrar Livro')

@section('content')

<div class="container">
    <h1 class="mt-4">Registrar Livro</h1>

    @if (session('mensagem'))
        <div class="alert alert-info">{{ session('mensagem') }}</div>
    @endif

    <form action="{{ route('salvarLivro') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do Livro</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="autor_id" class="form-label">Autor</label>
            <select class="form-control" id="autor_id" name="autor_id" required>
                <option value="">Selecione um autor</option>
                @foreach ($autores as $autor)
                    <option value="{{ $autor->id }}">{{ $autor->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="genero_id" class="form-label">Gênero</label>
            <select class="form-control" id="genero_id" name="genero_id" required>
                <option value="">Selecione um gênero</option>
                @foreach ($generos as $genero)
                    <option value="{{ $genero->id }}">{{ $genero->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="foto_livro" class="form-label">Foto do Livro (opcional)</label>
            <input type="file" class="form-control" id="foto_livro" name="foto_livro" onchange="previewImage(event)">
            <p class="mt-2">Preview da foto:</p>
            <img id="newImagePreview" class="img-thumbnail" style="max-width: 150px;">
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('newImagePreview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.onload = () => URL.revokeObjectURL(preview.src); // Libera a memória
    }
</script>

@endsection
