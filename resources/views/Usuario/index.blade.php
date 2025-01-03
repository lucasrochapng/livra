@extends('layouts.main')

@section('title', 'Usuários')

@section('content')

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->nome }}</td>
                <td>{{ $usuario->telefone }}</td>
                <td>{{ $usuario->tipo }}</td>
                <td>
                    <!-- Formulário de Exclusão -->
                    <form action="{{ url('deletarUsuario/'.$usuario->id) }}" method="POST" onsubmit="return confirm('TEM CERTEZA?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                    </form>
                </td>
                <td>
                    <a href="editarUsuario/{{$usuario->id}}" class="btn btn-warning btn-sm">Editar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection