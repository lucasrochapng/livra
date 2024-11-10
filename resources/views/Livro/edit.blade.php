@extends('layouts.main')

@section('title', 'Coleção')

@section('content')

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Livro</h2>

        <form action=" " method="POST" class="mb-3">
            @csrf
            @method('PUT')

            <!-- Campo Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $livro->titulo }}" placeholder="Digite o título do livro">
            </div>

            <!-- Campo Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" value="{{ $livro->autor }}" placeholder="Digite o autor do livro">
            </div>

            <!-- Campo Gênero -->
            <div class="mb-3">
                <label for="genero" class="form-label">Gênero</label>
                <input type="text" class="form-control" id="genero" name="genero" value="{{ $livro->genero }}" placeholder="Digite o gênero do livro">
            </div>

            <!-- Campo Descrição -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite a descrição do livro">{{ $livro->descricao }}</textarea>
            </div>

            <!-- Botão de Atualizar -->
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>

</body>

@endsection