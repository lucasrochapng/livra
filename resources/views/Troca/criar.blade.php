@extends('layouts.main')

@section('title', 'Oferecer Troca')

@section('content')
<div class="container">
    <h1 class="mt-4">Oferecer Troca</h1>

    <!-- Informações do Livro Selecionado -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $livroSelecionado->titulo }}</h5>
            <p class="text-muted">{{ $livroSelecionado->autor->nome ?? 'Autor desconhecido' }}</p>
            <p>{{ $livroSelecionado->descricao }}</p>
        </div>
    </div>

    <!-- Lista de Livros Disponíveis do Usuário -->
    <h3>Seus Livros Disponíveis</h3>
    <div class="row">
        @forelse($livrosDisponiveis as $livro)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $livro->titulo }}</h5>
                        <p class="text-muted">{{ $livro->autor->nome ?? 'Autor desconhecido' }}</p>
                        <p>{{ Str::limit($livro->descricao, 100) }}</p>
                        <form method="POST" action="{{ route('troca.store') }}">
                            @csrf
                            <input type="hidden" name="id_livro_ofertante" value="{{ $livro->id }}">
                            <input type="hidden" name="id_livro_receptor" value="{{ $livroSelecionado->id }}">
                            <button type="submit" class="btn btn-success">Propor Troca</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Você não possui livros disponíveis para troca.</p>
        @endforelse
    </div>
</div>
@endsection
