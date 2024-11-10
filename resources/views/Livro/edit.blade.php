<body>
    <form action=" " method="POST">
        @csrf
        @method('PUT')
        Título:
            <input type="text" name="titulo" value="{{ $livro->titulo }}">
        Autor:
            <input type="text" name="autor" value="{{ $livro->autor }}">
        Gênero:
            <input type="text" name="genero" value="{{ $livro->genero }}">
        Descrição:
            <input type="text" name="descricao" value="{{ $livro->descricao }}">

        <button type="submit">Atualizar</button>
    </form>
</body>