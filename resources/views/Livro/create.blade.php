@extends('layouts.main')

@section('title', 'Coleção')

@section('content')

<body>
    

    <div class="container mt-5">
        <h2 class="mb-4">Cadastrar Livro</h2>
        <!-- Exibir mensagem de sessão -->
        @if(session('mensagem'))
            <div class="alert alert-success">
                {{ session('mensagem') }}
            </div>
        @endif
        
        <form action="cadastrarLivro" method="post" class="mb-3">
            @csrf
            <!-- Título -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título do livro">
            </div>

            <!-- Autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" placeholder="Digite o autor do livro">
            </div>

            <!-- Gênero -->
            <div class="mb-3">
                <label for="genero" class="form-label">Gênero</label>
                <input type="text" class="form-control" id="genero" name="genero" placeholder="Digite o gênero do livro">
            </div>

            <!-- Descrição -->
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite a descrição do livro"></textarea>
            </div>

            <!-- Botão de enviar -->
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

        <!-- Link para listar livros -->
        <a href="{{ url('/listarLivro') }}" class="btn btn-secondary">Listar Livros</a>
    </div>

</body>

@endsection