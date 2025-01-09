@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="container">
    <h1 class="mt-4">Meus Livros</h1>
    <a href="{{ route('criarLivro') }}" class="btn btn-primary mb-4">Registrar Livro</a>

    @if (session('mensagem'))
        <div class="alert alert-info">{{ session('mensagem') }}</div>
    @endif

    <div class="row">
        @foreach($livros as $livro)
        <div class="col-12 mb-4">  <!-- Altere de col-md-3 para col-12 -->
            <div class="card h-100 d-flex flex-row">
                <!-- Imagem à esquerda (quadrada) -->
                <div style="width: 130px; height: 160px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    @if ($livro->foto_livro)
                        <img src="{{ asset('storage/' . $livro->foto_livro) }}" class="img-fluid" alt="Foto do Livro" style="object-fit: cover; height: 100%; width: 100%;"/>
                    @else
                        <img src="https://via.placeholder.com/150" class="img-fluid" alt="Foto não disponível" style="object-fit: cover; height: 100%; width: 100%;"/>
                    @endif
                </div>

                <!-- Conteúdo à direita (título, autor e gênero) -->
                <div class="card-body d-flex flex-column" style="flex: 1;">
                    <h5 class="card-title">{{ $livro->titulo }}</h5>
                    <p class="text-muted" style="font-size: 0.9rem;">
                        {{ $livro->autor->nome ?? 'Autor desconhecido' }} | 
                        {{ $livro->genero->nome ?? 'Gênero desconhecido' }}
                    </p>
                    <p class="card-text" style="font-size: 0.9rem; color: #555;">{{ Str::limit($livro->descricao, 120) }}</p>
                </div>

                <!-- Botões à direita -->
                <div class="d-flex flex-column justify-content-between align-items-end p-3">
                    <a href="{{ route('editarLivro', $livro->id) }}" class="btn btn-warning btn-sm mb-2">Editar</a>
                    <a href="{{ route('deletarLivro', $livro->id) }}" class="btn btn-danger btn-sm mb-2" 
                       onclick="return confirm('Tem certeza que deseja excluir este livro?');">Excluir</a>
                    @if ($livro->estado_atual === 'indisponivel')
                        <a href="{{ route('alterarEstadoLivro', $livro->id) }}" class="btn btn-success btn-sm">Encaminhar para Troca</a>
                    @elseif ($livro->estado_atual === 'disponivel')
                        <a href="{{ route('alterarEstadoLivro', $livro->id) }}" class="btn btn-secondary btn-sm">Retirar de Troca</a>
                    @elseif ($livro->estado_atual === 'em_andamento')
                        <button class="btn btn-secondary btn-sm" disabled>Troca em Andamento</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
