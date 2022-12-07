@extends('app.layouts.basico')

@section('titulo', 'Política de Privacidade')

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
              <li class="nav-item">
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

        <h2 class="mt-5 text-verde">Política de Privacidade</h2>
        <p>
          Todas as suas informações pessoais recolhidas serão usadas para o ajudar a tornar a sua visita no nosso site a mais produtiva e agradável possível.
        </p>
        <p>
          A garantia da confidencialidade dos dados pessoais dos usuários do nosso site é importante para a Libertá Negócios Imobiliarios.
        </p>
          Todas as informações pessoais relativas a clientes ou visitantes que usem o Libertá Negócios Imobiliarios serão tratadas em concordância com a Lei da Proteção de Dados Pessoais (Lei nº 13.709/2018).
        </p>
        <p>
          A informação pessoal recolhida pode incluir o seu nome, e-mail, número de telefone e/ou telefone celular, endereço, data de nascimento e outros dados relevantes.
        </p>
        <p>
          O uso do Libertá Negócios Imobiliarios pressupõe a aceitação deste Acordo de Privacidade. A equipe da Libertá Negócios Imobiliarios reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade de forma a estar sempre atualizado.
        </p>

        <h5 class="py-3 text-verde">Ligações a Sites de Terceiros</h5>
        <p>
          A Libertá Negócios Imobiliarios possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade não é aplicada a sites de terceiros, pelo que, caso visite outro site a partir do nosso deverá ler a política de privacidade do mesmo.
        </p>
        <p>
          Não nos responsabilizamos pela política de privacidade ou conteúdo presente em sites de terceiros.
        </p>

        <h5 class="py-3 text-verde">Contato</h5>
        <p>
          Se você tiver alguma dúvida sobre a política de privacidade da Libertá Negócios Imobiliarios, as bases legais para coleta, tratamento e armazenamento, os dados que mantemos sobre você ou se você gostaria de exercer um dos seus direitos de proteção de dados, não hesite em nos contactar. Envie um e-mail para: liberta@gmail.com.br
        </p>
        <p>
          Se você deseja formalizar uma reclamação ou se acha que a Libertá Negócios Imobiliarios não abordou seus dados de maneira satisfatória, entre em contato por e-mail: liberta@gmail.com.br
        </p>

        <h5 class="py-3 text-verde">Mediação e Foro</h5>
        <p>
          Esta política está sujeita à Lei da República Federativa do Brasil e o Foro da Comarca de Camboriú/SC é competente para dirimir qualquer controvérsia com relação à mesma.
        </p>
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
