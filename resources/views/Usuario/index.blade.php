@extends('layouts.main')

@section('title', 'Usuários')

@section('content')

<div class="container mt-5">
    <div class="row">
        <!-- Card da foto e nota -->
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100">
                <div class="card-body">
                    <!-- Imagem (pode ser um avatar padrão ou carregado do banco) -->
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->nome) }}&size=128" 
                         class="rounded-circle mb-3" alt="Avatar">
                    
                    <!-- Nome do Usuário -->
                    <h4>{{ $usuario->nome }}</h4>
                    
                    <!-- Nota e Ícone de Estrela -->
                    <p class="mb-0">
                        <strong>Média: </strong> 
                        {{ number_format($mediaNota, 1, ',', '.') ?? 'N/A' }}
                        <i class="fas fa-star text-warning"></i>
                    </p>
                </div>
            </div>
        </div>

        <!-- Card das Informações do Usuário -->
        <div class="col-md-8 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <!--teste-->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-link position-absolute" style="top: 10px; right: 10px;">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
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
                </div>
            </div>
        </div>


    </div>

    <!-- Card com as avaliações recebidas -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Avaliações Recebidas</h5>
                    @if ($avaliacoes->isEmpty())
                        <p>Você ainda não recebeu nenhuma avaliação.</p>
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

<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .rounded-circle {
        width: 128px;
        height: 128px;
        object-fit: cover;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .h-100 {
        height: 100%;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }
</style>
