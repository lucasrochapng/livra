@extends('layouts.main')

@section('title', 'Suporte')

@section('content')

    <!-- Cabeçalho -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Bem-vindo ao Suporte do Livra</h1>
            <p class="lead">Estamos aqui para ajudar você a aproveitar ao máximo a plataforma.</p>
        </div>
    </header>

    <!-- Seção de FAQs -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Perguntas Frequentes</h2>
            <div class="row g-4">
                <!-- Pergunta 1 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-book-open fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Como cadastrar um livro?</h5>
                            <p class="card-text">
                                Acesse a aba "Coleção" no menu principal, clique em "Registrar Livro", preencha os dados solicitados e salve.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Pergunta 2 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-search fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Como encontrar usuários para trocar livros?</h5>
                            <p class="card-text">
                                Use a aba "Acervo" para navegar pelos livros disponíveis. Clique em um livro para enviar uma solicitação de troca.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Pergunta 3 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Como avaliar um usuário?</h5>
                            <p class="card-text">
                                Após realizar uma troca, acesse a opção de usuário "avaliações" e preencha o formulário.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Formulário de Contato -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Fale Conosco</h2>
            <form action="/enviar-suporte" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
