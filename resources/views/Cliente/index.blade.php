<body>
    <table>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->email }}</td>
                <td>
                    <form action="" method="POST" onsubmit="return confirm('TEM CERTEZA?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Deletar</button>
                    </form>
                </td>
                <td>
                    <a href="editarCliente/{{$cliente->id}}">Editar</a>
                </td>
            </tr>
        @endforeach
    </table>

    <form action="deletarCliente/{{ $cliente->id }}" method="DELETE">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>



</body>