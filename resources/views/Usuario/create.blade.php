<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuário</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Registro de Usuário</h3>

                <form action="{{ url('cadastrarUsuario') }}" method="POST">
                    @csrf
                    
                    @if (session('mensagem'))
                        <div class="alert alert-info" role="alert">
                            {{ session('mensagem') }}
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" class="form-control" id="nome" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" class="form-control" id="senha" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" class="form-control" id="telefone">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                </form>

                <div class="mt-3 text-center">
                    <p>Já tem uma conta? <a href="{{ url('/login') }}" class="text-primary">Faça login</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
