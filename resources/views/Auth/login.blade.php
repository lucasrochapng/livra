<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Livra</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            height: 100vh;
        }
        .left-panel {
            background: url('img/banner-mulher.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        .left-panel h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }
        .left-panel p {
            margin-top: 1rem;
            font-size: 1.2rem;
        }
        .right-panel {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        .card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Painel Esquerdo -->
            <div class="col-md-6 left-panel">
                <!-- <h1>Livra</h1>
                <p>.</p> -->
            </div>

            <!-- Painel Direito -->
            <div class="col-md-6 right-panel">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Login</h3>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </form>
                        <div class="mt-3 text-center">
                            <p>Não possui uma conta? <a href="{{ url('/cadastrarUsuario') }}">Registre-se</a></p>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <p>{{ $errors->first('email') }}</p>
                            </div>
                        @endif
                    </div>
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
