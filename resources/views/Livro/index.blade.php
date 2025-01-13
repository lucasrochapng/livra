@extends('layouts.main')

@section('title', 'Coleção')

@section('content')

<div class="container">
    <h1 class="mt-4">Meus Livros</h1>
    <a href="{{ route('criarLivro') }}" class="btn btn-primary mb-4">Registrar Livro</a>

    @if (session('mensagem'))
        <div class="alert alert-info">{{ session('mensagem') }}</div>
    @endif

    <div class="row">
        @foreach($livros as $livro)
        <div class="col-12 mb-4">
            <div class="card h-100 d-flex flex-row" style="height: 180px;">
                <!-- Imagem à esquerda -->
                <div style="width: 130px; height: 100%; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                    @if ($livro->foto_livro)
                        <img src="{{ asset('storage/' . $livro->foto_livro) }}" class="img-fluid" alt="Foto do Livro" 
                            style="object-fit: cover; width: 100%; height: 100%;"/>
                    @else
                        <img src="https://via.placeholder.com/150" class="img-fluid" alt="Foto não disponível" 
                            style="object-fit: cover; width: 100%; height: 100%;"/>
                    @endif
                </div>

                <!-- Conteúdo à direita -->
                <div class="card-body d-flex flex-column" style="flex: 1;">
                    <h5 class="card-title" style="margin-bottom: 0.5rem;">{{ $livro->titulo }}</h5>
                    <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 0.5rem;">
                        {{ $livro->autor->nome ?? 'Autor desconhecido' }} | 
                        {{ $livro->genero->nome ?? 'Gênero desconhecido' }}
                    </p>
                    
                    <!-- Espaço para descrição -->
                    <p class="card-text" style="font-size: 0.8rem; color: #555; line-height: 1.4; margin-bottom: 0.5rem;">
                        {{ Str::limit($livro->descricao, 350) }}
                    </p>

                    <!-- Botões na parte inferior -->
                    <div class="d-flex align-items-start mt-auto" style="gap: 0.5rem;">
                        <a href="{{ route('editarLivro', $livro->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{ route('deletarLivro', $livro->id) }}" class="btn btn-danger btn-sm" 
                        onclick="return confirm('Tem certeza que deseja excluir este livro?');">Excluir</a>

                        <!-- Lógica para o botão de troca -->
                        @if ($livro->estado_atual === 'indisponivel')
                            <a href="{{ route('alterarEstadoLivro', $livro->id) }}" class="btn btn-success btn-sm">Encaminhar para Troca</a>
                        @elseif ($livro->estado_atual === 'disponivel')
                            <a href="{{ route('alterarEstadoLivro', $livro->id) }}" class="btn btn-warning btn-sm">Retirar de Troca</a>
                        @elseif ($livro->estado_atual === 'em_andamento')
                            <button class="btn btn-secondary btn-sm" disabled>Troca em Andamento</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
