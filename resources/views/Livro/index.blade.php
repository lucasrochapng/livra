@extends('layouts.main')

@section('title', 'Coleção')

@section('content')

<body>
    <!-- Campo de pesquisa -->
    <div>
        <label for="filtro">Digite um nome para filtrar:</label>
        <input type="text" id="filtro" placeholder="Digite o título do livro">
    </div>

    <table>
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
                        <form action="deletarLivro/{{ $livro->id }}" method="POST" onsubmit="return confirm('TEM CERTEZA?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Deletar</button>
                        </form>
                    </td>
                    <td>
                        <a href="editarLivro/{{$livro->id}}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Script de filtro -->
    <script>
        // Seleciona o campo de filtro e adiciona o evento
        document.getElementById('filtro').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let livros = document.querySelectorAll('tbody .livro');

            livros.forEach(function(livro) {
                let titulo = livro.querySelector('.titulo').textContent.toLowerCase();
                if (titulo.includes(filtro)) {
                    livro.style.display = ''; // Exibe o livro
                } else {
                    livro.style.display = 'none'; // Oculta o livro
                }
            });
        });
    </script>
</body>

@endsection
