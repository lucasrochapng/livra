@extends('layouts.main')

@section('title', 'Oferecer Troca')

@section('content')
<div class="container">
    <h1 class="text-center">Oferecer Troca</h1>

    <!-- Livro solicitado -->
    <div class="card mb-4">
        <h5 class="card-header">Livro Solicitado</h5>
        <div class="card-body">
            <h5 class="card-title">{{ $livro->titulo }}</h5>
            <p class="card-text">{{ $livro->descricao }}</p>
        </div>
    </div>

    <!-- Livros do usuário -->
    <form action="{{ route('troca.store') }}" method="POST">
        @csrf
        <input type="hidden" name="livro_solicitado" value="{{ $livro->id }}">
        <div class="card mb-4">
            <h5 class="card-header">Escolha um Livro para Troca</h5>
            <div class="card-body">
                @forelse($usuarioLivros as $usuarioLivro)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="livro_oferecido" id="livro-{{ $usuarioLivro->livro->id }}" value="{{ $usuarioLivro->id }}">
                        <label class="form-check-label" for="livro-{{ $usuarioLivro->livro->id }}">
                            {{ $usuarioLivro->livro->titulo }}
                        </label>
                    </div>
                @empty
                    <p>Você não tem livros disponíveis para troca.</p>
                @endforelse
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Solicitação</button>
    </form>
</div>
@endsection
