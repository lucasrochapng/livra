@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="container-fluid p-0">
    <!-- Seção do Banner com Sombra -->
    <div class="banner" style="position: relative; overflow: hidden;">
        <img src="/img/banner.jpg" class="img-fluid" alt="Banner" style="width: 100%; height: auto;">

        <!-- Sombra -->
        <div class="shadow-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5);"></div>

        <!-- Conteúdo da Divisão -->
        <div class="row position-absolute justify-content-center align-items-center" style="width: 100%; top: 50%; transform: translateY(-50%); z-index: 2;">
            <div class="col-md-5 d-flex align-items-center text-white text-md-left" style=""> 
                <div>
                    <h1>Sua Comunidade Literária</h1>
                    <p>Conecte-se com amantes de livros, troque histórias e aproveite benefícios exclusivos enquanto expande sua coleção literária!</p>
                    <a href="{{ url('/listarUsuario') }}" class="btn btn-primary">Comece já</a>
                </div>
            </div>
            <div class="col-md-4 text-center" style=""> 
                <img src="/img/mascote.png" alt="Mascote" class="img-fluid" style="max-height: 300px; width: auto;">
            </div>
        </div>
    </div>
</div>


<div class="container mt-4 text-center">
    <h2>Descubra Mais Sobre Nossa Plataforma</h2>
    <p>Aproveite os recursos que oferecemos e faça parte de uma comunidade literária vibrante!</p>
</div>


<!-- Container para os Cards -->
<div class="container mt-4">
    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="/img/card1.jpg" class="card-img-top" alt="Imagem 1">
                <div class="card-body">
                    <h5 class="card-title">Conecte-se com leitores</h5>
                    <p class="card-text">Faça parte de uma comunidade de amantes da leitura e descubra novos amigos com os mesmos interesses literários.</p>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="/img/card2.jpg" class="card-img-top" alt="Imagem 2">
                <div class="card-body">
                    <h5 class="card-title">Troque livros</h5>
                    <p class="card-text">Encontre e troque livros com outros usuários, expandindo sua coleção de maneira simples e prática.</p>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="/img/card3.jpg" class="card-img-top" alt="Imagem 3">
                <div class="card-body">
                    <h5 class="card-title">Ganhe moedas e descontos</h5>
                    <p class="card-text">Acumule moedas virtuais e receba descontos exclusivos em produtos de nossos parceiros.</p>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
