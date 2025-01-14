@extends('layouts.main')

@section('title', 'Acervo')

@section('content')
<div class="container">
    <h1 class="mt-4">Acervo de Livros</h1>

    <!-- Barra de pesquisa e filtro -->
    <form method="GET" action="{{ route('acervo') }}" class="mb-4">
        <div class="input-group gap-2 align-items-center" style="gap: 0.5rem;">
            <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar..." value="{{ request('pesquisa') }}">
            
            <select name="filtro" class="form-select" style="max-width: 150px;">
                <option value="titulo" {{ request('filtro') == 'titulo' ? 'selected' : '' }}>Título</option>
                <option value="autor" {{ request('filtro') == 'autor' ? 'selected' : '' }}>Autor</option>
                <option value="genero" {{ request('filtro') == 'genero' ? 'selected' : '' }}>Gênero</option>
            </select>

            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <!-- Filtro por letras -->
    <div class="d-flex flex-wrap mb-4 gap-1" style="gap: 0.5rem;">
        @foreach(range('A', 'Z') as $letra)
            <a href="{{ route('acervo', ['letra' => $letra]) }}" 
               class="btn btn-outline-secondary me-1 mb-1 {{ request('letra') == $letra ? 'active' : '' }}"
               style="font-size: 0.75rem; padding: 0.25rem 0.5rem;">
                {{ $letra }}
            </a>
        @endforeach
    </div>

    <!-- Lista de livros -->
    <div class="row">
        @forelse($livros as $livro)
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
                        <h5 class="card-title" style="font-size: 1rem; margin-bottom: 0.25rem;">{{ $livro->titulo }}</h5>
                        <p class="text-muted" style="font-size: 0.85rem; margin-bottom: 0.25rem;">
                            {{ $livro->autor->nome ?? 'Autor desconhecido' }} | 
                            {{ $livro->genero->nome ?? 'Gênero desconhecido' }}
                        </p>
                        <p class="card-text" style="font-size: 0.75rem; color: #555; line-height: 1.2; margin-bottom: 0.5rem;">
                            {{ Str::limit($livro->descricao, 350) }}
                        </p>
                        <p class="text-muted" style="font-size: 0.85rem; margin-top: auto;">
                            <strong>Dono do Livro:</strong> {{ $livro->usuario->first()->nome ?? 'Desconhecido' }}
                        </p>
                        <div class="d-flex justify-content-start mt-2">
                            <a href="{{ route('oferecerTroca', $livro->id) }}" class="btn btn-primary btn-sm">Oferecer Troca</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Nenhum livro encontrado.</p>
        @endforelse
    </div>
</div>
@endsection
