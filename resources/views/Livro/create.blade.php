<form action="cadastrarLivro" method="post">
@csrf
    <p>{{session('mensagem')}}</p>
    Título: <input type="text" name="titulo">
    Autor: <input type="text" name="autor">
    Gênero: <input type="text" name="genero">
    Descrição: <input type="text" name="descricao">
    <input type="submit" value="Cadastrar">
</form>
<a href="{{ url('/listarLivro') }}">Listar Livros</a>