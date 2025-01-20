@extends('layouts.main')

@section('title', 'Oferecer Troca')

@section('content')

<div class="container">
    <h2 class="mt-4" style="font-size: 1.5rem; font-weight: bold; color:rgb(109, 109, 109); text-align: left;">
        Avaliações Pendentes
    </h2>

    @forelse ($avaliacoesPendentes as $pendente)
        <div class="card mb-3">
            <div class="card-body">
                <p>
                    Avalie o usuário <strong>{{ $pendente->usuarioAvaliado->nome }}</strong> com quem você realizou uma troca.
                </p>
                <form action="{{ route('avaliacoes.avaliar', $pendente->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nota" class="form-label">Nota (0 a 5)</label>
                        <input type="number" class="form-control" id="nota" name="nota" min="0" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Comentário (opcional)</label>
                        <textarea class="form-control" id="comentario" name="comentario"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
                </form>
            </div>
        </div>
    @empty
        <p>Você não possui avaliações pendentes.</p>
    @endforelse
</div>



@endsection
