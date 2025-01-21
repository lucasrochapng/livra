@extends('layouts.main')

@section('title', 'Sobre Nós')

@section('content')

    <style>
        .hero {
            background: url('https://source.unsplash.com/1600x500/?books,library') center/cover no-repeat;
            height: 60vh;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hero h1 {
            font-size: 3rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
        }
        .team img {
            border-radius: 50%;
        }
    </style>

    <!-- Sobre Nós -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4">Nossa Missão</h2>
                    <p class="text-muted">
                        O Livra foi criado para conectar leitores apaixonados e promover o compartilhamento de conhecimento. Acreditamos que cada livro carrega um universo e que todos devem ter acesso a ele.
                    </p>
                    <p class="text-muted">
                        Nossa plataforma permite que você troque livros com segurança, se conectando a usuários bem avaliados.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="img/jovem.jpg" alt="Livra Missão" style="width: 500px">
                </div>
            </div>
        </div>
    </section>

    <!-- Valores -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h2 class="mb-4">Nossos Valores</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm">
                        <i class="fas fa-book fa-3x text-primary mb-3"></i>
                        <h5>Paixão pela Leitura</h5>
                        <p class="text-muted">Promover o amor pelos livros e incentivar a leitura em todas as idades.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm">
                        <i class="fas fa-people-arrows fa-3x text-success mb-3"></i>
                        <h5>Conexão</h5>
                        <p class="text-muted">Criar laços entre leitores e comunidades locais.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm">
                        <i class="fas fa-shield-alt fa-3x text-warning mb-3"></i>
                        <h5>Segurança</h5>
                        <p class="text-muted">Garantir trocas seguras e confiáveis com usuários bem avaliados.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Nossa Equipe -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Nossa Equipe</h2>

        <div class="row g-4 text-center justify-content-center">
            
            <div class="col-md-4">
                <div class="team-member">
                    <img src="img/lucas.jpg" alt="Lucas Rocha" class="team-photo mb-3">
                    <h5>Lucas Rocha</h5>
                    <p class="text-muted">Fundador e Desenvolvedor</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="team-member">
                    <img src="img/polly.jpg" alt="Pollyana Machado" class="team-photo mb-3">
                    <h5>Pollyana Machado</h5>
                    <p class="text-muted">Gerente de Projetos</p>
                </div>
            </div>

            <!-- Exemplo de terceiro membro descomentado -->
            <!-- <div class="col-md-4">
                <div class="team-member">
                    <img src="img/joao.jpg" alt="João Pereira" class="team-photo mb-3">
                    <h5>João Pereira</h5>
                    <p class="text-muted">Designer UX/UI</p>
                </div>
            </div> -->
        </div>
    </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection
