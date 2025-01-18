@extends('layouts.main')

@section('title', 'Minhas Trocas')

@section('content')

<div class="container">
    <h2>Trocas Recebidas</h2>
    @forelse ($trocasRecebidas as $troca)
        <div class="card mb-3">
            <div class="card-body">
                <p>
                    <strong>{{ $troca->usuarioOfertante->nome }}</strong> está interessado em seu livro
                    <strong>{{ $troca->livroReceptor->titulo }}</strong> e está lhe oferecendo o livro
                    <strong>{{ $troca->livroOfertante->titulo }}</strong>.
                </p>
                <button class="btn btn-success">Aceitar</button>
                <button class="btn btn-danger">Recusar</button>
            </div>
        </div>
    @empty
        <p>Você não possui trocas recebidas.</p>
    @endforelse

    <h2>Trocas Enviadas</h2>
    @forelse ($trocasEnviadas as $troca)
        <div class="card mb-3">
            <div class="card-body">
                <p>
                    Você propôs trocar o livro <strong>{{ $troca->livroOfertante->titulo }}</strong> pelo livro
                    <strong>{{ $troca->livroReceptor->titulo }}</strong> de
                    <strong>{{ $troca->usuarioReceptor->nome }}</strong>.
                </p>
                <button class="btn btn-warning">Cancelar Proposta</button>
            </div>
        </div>
    @empty
        <p>Você não possui trocas enviadas.</p>
    @endforelse
</div>


@endsection
