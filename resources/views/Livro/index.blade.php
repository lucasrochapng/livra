@extends('layouts.main')

@section('title', 'Coleção')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">Coleção de Livros</h2>

    <!-- Campo de pesquisa -->
    <div class="mb-3">
        <label for="filtro" class="form-label">Digite um nome para filtrar:</label>
        <input type="text" id="filtro" class="form-control" placeholder="Digite o título do livro">
    </div>

    <!-- Tabela de livros -->
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($livros as $livro)
                <tr class="livro">
                    <td class="titulo">{{ $livro->titulo }}</td>
                    <td>{{ $livro->autor }}</td>
                    <td>{{ $livro->genero }}</td>
                    <td>{{ $livro->descricao }}</td>
                    <td>
                        <!-- Botão de deletar com Bootstrap -->
                        <form action="deletarLivro/{{ $livro->id }}" method="POST" onsubmit="return confirm('TEM CERTEZA?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                        </form>

                        <!-- Link para editar com Bootstrap -->
                        <a href="editarLivro/{{$livro->id}}" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script de filtro -->
<script>
    // Campo de filtro para pesquisa
    document.getElementById('filtro').addEventListener('keyup', function() {
        let filtro = this.value.toLowerCase();
        let livros = document.querySelectorAll('tbody .livro');

        livros.forEach(function(livro) {
            let titulo = livro.querySelector('.titulo').textContent.toLowerCase();
            livro.style.display = titulo.includes(filtro) ? '' : 'none';
        });
    });
</script>

@endsection
