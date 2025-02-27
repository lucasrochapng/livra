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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
                <!-- Início -->
                <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/home') }}">Início</a>
                </li>
                <!-- Lista de livros disponíveis para troca -->
                <li class="nav-item {{ request()->is('acervo') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/acervo') }}">Acervo</a>
                </li>
                <!-- Lista de livros do usuário -->
                <li class="nav-item {{ request()->is('livros') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/livros') }}">Coleção</a>
                </li>
                <!-- Lista com os pedidos de trocas em andamento -->
                <li class="nav-item {{ request()->is('trocas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/trocas') }}">Trocas</a>
                </li>
                <!-- Ícone de usuário -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <i class="bi bi-person-circle"></i> -->
                        @if(Auth::check())
                            <!-- Exibe o avatar do usuário autenticado -->
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nome) }}&size=32"
                                class="rounded-circle" alt="Avatar" style="width: 24px; height: 24px;">
                        @else
                            <!-- Exibe um ícone genérico se o usuário não estiver autenticado -->
                            <i class="bi bi-person-circle"></i>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        @if(Auth::check())
                            <span class="dropdown-item font-weight-bold">{{ Auth::user()->nome }}</span>
                            <a class="dropdown-item" href="{{ url('/usuario') }}">Perfil</a>
                            <a class="dropdown-item" href="{{ url('/avaliacoes/pendentes') }}">Avaliações</a>
                            <a class="dropdown-item" href="{{ url('/faleconosco') }}">Suporte</a>
                            <a class="dropdown-item" href="{{ url('/sobre') }}">Sobre Nós</a>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a class="dropdown-item" href="{{ url('/login') }}">Entrar</a>
                            <a class="dropdown-item" href="{{ url('/faleconosco') }}">Suporte</a>
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
        <p>© 2025 Livra. Todos os direitos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
