@extends('layouts.main')

@section('title', 'Acervo')

@section('content')

<div class="container">
    <h1 class="mt-4">Acervo de Livros</h1>

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
                        <h5 class="card-title" style="font-size: 1rem; margin-bottom: 0.25rem;">{{ $livro->titulo }}</h5> <!-- Título -->
                        <p class="text-muted" style="font-size: 0.85rem; margin-bottom: 0.25rem;">
                            {{ $livro->autor->nome ?? 'Autor desconhecido' }} | 
                            {{ $livro->genero->nome ?? 'Gênero desconhecido' }}
                        </p>
                        
                        <!-- Espaço para descrição -->
                        <p class="card-text" style="font-size: 0.75rem; color: #555; line-height: 1.2; margin-bottom: 0.5rem;">
                            {{ Str::limit($livro->descricao, 350) }}
                        </p>
                        
                        <!-- Nome do Usuário (dono do livro) -->
                        <p class="text-muted" style="font-size: 0.85rem; margin-top: auto;">
                            <strong>Dono do Livro:</strong> {{ $livro->usuario->first()->nome ?? 'Desconhecido' }}
                        </p>

                        <!-- Botão abaixo das palavras -->
                        <div class="d-flex justify-content-start mt-2">
                            <a href="{{ route('oferecerTroca', $livro->id) }}" class="btn btn-primary btn-sm">Oferecer Troca</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
