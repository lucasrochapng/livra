<body>
    <form action="" method="POST">
        @csrf
        @method('PUT')
        Nome:
            <input type="text" name="nome" value="{{ $cliente->nome }}">
        CPF:
            <input type="text" name="cpf" value="{{ $cliente->cpf }}">
        Telefone:
            <input type="text" name="telefone" value="{{ $cliente->telefone }}">
        Email:
            <input type="text" name="email" value="{{ $cliente->email }}">

        <button type="submit">Atualizar</button>
    </form>
</body>