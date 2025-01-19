@extends('layouts.main')

@section('title', 'Minhas Trocas')

@section('content')

<div class="container">
    <h2 class="mt-4" style="font-size: 1.5rem; font-weight: bold; color:rgb(109, 109, 109); text-align: left;">
        Trocas Recebidas
    </h2>
    @forelse ($trocasRecebidas as $troca)
        <div class="card mb-3">
            <div class="card-body">
                <p>
                    <strong>{{ $troca->usuarioOfertante->nome }}</strong> está interessado em seu livro
                    <strong>{{ $troca->livroReceptor->titulo }}</strong> e está lhe oferecendo o livro
                    <strong>{{ $troca->livroOfertante->titulo }}</strong>.
                </p>
                <form action="{{ route('troca.aceitar', $troca->troca->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success">Aceitar</button>
                </form>
                <form action="{{ route('troca.recusar', $troca->troca->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger">Recusar</button>
                </form>
            </div>
        </div>
    @empty
        <p>Você não possui nenhuma solicitação de troca para os seus livros.</p>
    @endforelse

    <h2 class="mt-4" style="font-size: 1.5rem; font-weight: bold; color:rgb(109, 109, 109); text-align: left;">
        Trocas Enviadas
    </h2>
    @forelse ($trocasEnviadas as $troca)
        <div class="card mb-3">
            <div class="card-body">
                <p>
                    Você propôs trocar o livro <strong>{{ $troca->livroOfertante->titulo }}</strong> pelo livro
                    <strong>{{ $troca->livroReceptor->titulo }}</strong> de
                    <strong>{{ $troca->usuarioReceptor->nome }}</strong>.
                </p>
                <form action="{{ route('troca.cancelar', $troca->troca->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-warning">Cancelar Proposta</button>
                </form>
            </div>
        </div>
    @empty
        <p>Você não solicitou nenhuma troca de livros.</p>
    @endforelse
</div>

    <div class="container">
        <h2 class="mt-4" style="font-size: 1.5rem; font-weight: bold; color:rgb(109, 109, 109); text-align: left;">
            Trocas em Andamento
        </h2>
        @forelse ($trocas as $troca)
            <div class="card mb-3">
                <div class="card-body">
                    @if ($troca->papel === 'ofertante')
                        <p>
                            Para formalizar a troca, por favor, entre em contato com 
                            <strong>{{ $troca->trocaLivros->first()->usuarioReceptor->nome }}</strong> pelo WhatsApp.
                            Assim, vocês poderão alinhar os detalhes e dar continuidade ao processo. Obrigado!
                        </p>
                        <a href="https://wa.me/{{ $troca->trocaLivros->first()->usuarioReceptor->telefone }}" target="_blank" class="btn btn-success">
                            <i class="fa fa-whatsapp"></i> WhatsApp
                        </a>
                    @elseif ($troca->papel === 'receptor')
                        <p>
                            Para formalizar a troca, por favor, entre em contato com 
                            <strong>{{ $troca->trocaLivros->first()->usuarioOfertante->nome }}</strong> pelo WhatsApp.
                            Assim, vocês poderão alinhar os detalhes e dar continuidade ao processo. Obrigado!
                        </p>
                        <a href="https://wa.me/{{ $troca->trocaLivros->first()->usuarioOfertante->telefone }}" target="_blank" class="btn btn-success">
                            <i class="fa fa-whatsapp"></i> WhatsApp
                        </a>
                    @endif
                    <form action="{{ route('troca.finalizar', $troca->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary">Troca Finalizada</button>
                    </form>

                </div>
            </div>
        @empty
            <p>Você não possui trocas em andamento.</p>
        @endforelse
    </div>





@endsection
