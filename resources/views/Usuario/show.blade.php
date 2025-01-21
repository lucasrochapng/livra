@extends('layouts.main')

@section('title', "Perfil de $usuario->nome")

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->nome) }}&size=128" 
                         class="rounded-circle mb-3" alt="Avatar">
                    <h4>{{ $usuario->nome }}</h4>
                    <p class="mb-0">
                        <strong>Média:</strong> {{ number_format($mediaNota, 1, ',', '.') ?? 'N/A' }}
                        <i class="fas fa-star text-warning"></i>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4"><strong>Nome</strong></div>
                        <div class="col-8 text-muted">{{ $usuario->nome }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><strong>Email</strong></div>
                        <div class="col-8 text-muted">{{ $usuario->email }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><strong>Telefone</strong></div>
                        <div class="col-8 text-muted">{{ $usuario->telefone ?? 'Não informado' }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4"><strong>Trocas Concluídas</strong></div>
                        <div class="col-8 text-muted">{{ $trocasConcluidas }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Avaliações Recebidas</h5>
                    @if ($avaliacoes->isEmpty())
                        <p>Este usuário ainda não recebeu nenhuma avaliação.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($avaliacoes as $avaliacao)
                                <li class="list-group-item">
                                    <p>
                                        <strong>{{ $avaliacao->avaliador->nome }}</strong>
                                        <span class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $avaliacao->nota ? '' : '-o' }}"></i>
                                            @endfor
                                        </span>
                                    </p>
                                    <p>{{ $avaliacao->comentario }}</p>
                                    <p class="text-muted" style="font-size: 0.85rem;">
                                        <em>Avaliado em {{ $avaliacao->created_at->format('d/m/Y H:i') }}</em>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
