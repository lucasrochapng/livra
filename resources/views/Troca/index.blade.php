@extends('layouts.main')

@section('title', 'Minhas Trocas')

@section('content')

<div class="container">
    <h1>Trocas Recebidas</h1>
    <div class="row">
        @foreach ($trocas as $troca)
            <div class="card">
                <div class="card-body">
                    <p>
                        {{ $troca->usuarioOfertante->nome }} está interessado em seu livro 
                        <strong>{{ $troca->livroReceptor->titulo }}</strong> e está lhe oferecendo o livro 
                        <strong>{{ $troca->livroOfertante->titulo }}</strong>.
                    </p>
                    <button class="btn btn-primary">Aceitar</button>
                    <button class="btn btn-danger">Recusar</button>
                </div>
            </div>
        @endforeach


    </div>
</div>


@endsection
