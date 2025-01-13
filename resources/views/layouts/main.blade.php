<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

    <!-- Cabeçalho -->
    <nav class="navbar navbar-expand-lg bg-primary">
        <a class="navbar-brand" href="#">
            <img src="/img/logo.png" alt="logo livra">
            <span>LIVRA</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- inicio -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/home') }}">Início</a>
                </li>
                <!-- lista de livros disponíveis para troca -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/acervo') }}">Acervo</a>
                </li>
                <!-- lista de livros do usuário -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/livros') }}">Coleção</a>
                </li>
                <!-- lista com os pedidos de trocas em andamento -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Trocas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/faleconosco') }}">Contato</a>
                </li>
                <!-- janela de opções do usuário -->
                <!-- Ícone de usuário -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        @if(Auth::check())
                            <span class="dropdown-item font-weight-bold">{{ Auth::user()->nome }}</span>
                            <a class="dropdown-item" href="{{ url('/configuracoes') }}">Configurações</a>
                            <a class="dropdown-item" href="{{ url('/suporte') }}">Suporte</a>
                            <a class="dropdown-item" href="{{ url('/sobre') }}">Sobre Nós</a>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a class="dropdown-item" href="{{ url('/login') }}">Entrar</a>
                            <a class="dropdown-item" href="{{ url('/suporte') }}">Suporte</a>
                            <a class="dropdown-item" href="{{ url('/sobre') }}">Sobre Nós</a>
                        @endif
                    </div>
                </li>

            </ul>
        </div>
    </nav>

    @yield('content')

    <!-- Rodapé -->
    <footer class="bg-light text-center py-3">
        <p>© 2024 Livra. Todos os direitos reservados.</p>
    </footer>

    <script>
        $(document).ready(function () {
            $('#userDropdown').click(function () {
                $(this).next('.dropdown-menu').toggle();
            });
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
