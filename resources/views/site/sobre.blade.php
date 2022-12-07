@extends('app.layouts.basico')

@section('titulo', 'Sobre')

@section('conteudo')

    <header class="pt-3 pb-5">
      <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container">
          <a href="{{route('site.index')}}" class="navbar-brand">
            <img src="{{asset('img/liberta.jpg')}}" width="142">
          </a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-principal">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="nav-principal">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{route('site.index')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('site.busca')}}">Imóveis</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{route('site.sobre')}}">Sobre</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('site.mensagem')}}">Contato</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <section>
      <div class="container">
        <div class="row pt-5 pb-3">
          <div class="col-md-12">
            <h1 class="text-verde">Sobre a empresa</h1>
            <p>A empresa Libertá Negócios Imobiliários nasceu do desejo da corretora de imóveis, Maryana Schmidt Pinto, em criar a sua própria empresa, com sede em Camboriú/SC. Há cerca de um ano, Maryana iniciou a Libertá, com foco na venda de apartamentos, casas e sobrados no Litoral Norte de Santa Catarina, principalmente nas cidades de Camboriú e Ilhota, por conta do crescimento desses municípios em virtude da proximidade com grandes centros urbanos, como Itajaí e Balneário Camboriú.</p>

            <p>Desde o princípio, a Libertá busca oferecer a possibilidade de "liberdade" aos clientes a fim de facilitar a conquista da casa própria e realizar esse sonho. Outro diferencial da empresa, dá-se em suas possibilidades de produtos, incluindo projetos na planta ou prontos para morar, visando atender a todas as necessidades dos compradores.</p>
          </div>
        </div>
        <div class="row pt-3">
          <div class="col-md-4 d-flex flex-wrap">
            <h5>Missão</h5>
            <p>Realizar transações imobiliárias com segurança e transparência, por meio de equipes capacitadas e atendimento de excelência, buscando constante evolução e inovação.</p>
          </div>
          <div class="col-md-4 d-flex flex-wrap">
            <h5>Visão</h5>
            <p>Ser a Imobiliária de referência no Vale de Itajaí, reconhecida como a melhor opção por clientes, colaboradores, comunidade, fornecedores e investidores, pela qualidade de nossos produtos, serviços e relacionamento.</p>
          </div>
          <div class="col-md-4 d-flex flex-wrap">
            <h5>Valores</h5>
            <p>Buscamos oferecer o que há de melhor em desempenho, competência, transparência e confiabilidade para a realização de seus negócios.</p>
          </div>
        </div>



      </div>
    </section>


    <footer id="acompanhe" class="mt-4">
      <div class="container">
        <div class="row p-4">
          <div class="col-md-2">
            <a href="{{route('site.index')}}" class="navbar-brand">
              <img src="{{asset('img/liberta.jpg')}}" width="142">
            </a>
          </div>
          <div class="col-md-7 d-flex flex-wrap align-content-center">
            <h4 style="font-size: 19px">
              Especialista em imóveis no<br> Litoral Norte de Santa Catarina <br>
            </h4>
            <p style="font-size: 14px;">
              Balneário Camboriú | Camboriú | Ilhota | Itajaí | Porto Belo
            </p>
          </div>
          <div class="col-md-3">
            <span class="mb-1">Acompanhe</span><br>
            <a href="#"><img src="{{asset('img/whatsapp.png')}}" width="50px" height="50px"></a>
            <a href="#"><img src="{{asset('img/facebook.png')}}" width="50px" height="50px"></a>
            <a href="#"><img src="{{asset('img/instagram.png')}}" width="50px" height="50px"></a>
            <a href="#"><img src="{{asset('img/mail.png')}}" width="50px" height="50px"></a>
          </div>
        </div>
      </div>
    </footer>

    <footer id="copy">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            &copy; 2022 Libertá Negócios Imobiliários - CRECI 00000J
          </div>
          <div class="col-md-6 text-right">
            <a href="{{ route('site.politica') }}">Política de Privacidade</a> | Desenvolvido por <a
                href="https://www.linkedin.com/in/alison-martins-3b4529227/" target="_blank">Alison Martins</a>
        </div>
        </div>
      </div>
    </footer>
@endsection
