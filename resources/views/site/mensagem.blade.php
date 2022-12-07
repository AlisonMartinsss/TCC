@extends('app.layouts.basico')

@section('titulo', 'Entre em contato')

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
              <li class="nav-item active">
                <a class="nav-link" href="{{route('site.mensagem')}}">Contato</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <section>
        <div class="container pt-4">
            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </section>

    <section>
      <div class="container">
        <h1 class="pt-3 pb-3 text-verde text-center">Entre em contato conosco</h1>
        <form action="{{route('site.mensagem')}}" method="POST">
          @csrf
          <div class="form-row mt-3">
            <div class="form-group col-md-12">
              <input type="text"class="form-control" name="nome" placeholder="Nome Completo">
              <span class="text-error">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
            </div>
          </div>
          <div class="form-row mt-3">
            <div class="form-group col-md-6">
              <input type="email" class="form-control" name="email" placeholder="E-mail">
              <span class="text-error">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
            </div>
            <div class="form-group col-md-6">
              <input type="tel" class="form-control" name="telefone" placeholder="Telefone">
              <span class="text-error">{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</span>
            </div>
          </div>
          <div class="form-row mt-3">
            <div class="form-group col-md-12">
                <select class="custom-select" name="assunto_id">
                    <option value="">Assunto</option>
                    @foreach ($assuntos as $assunto)
                        <option value="{{ $assunto->id }}">
                            {{ $assunto->descricao }}
                        </option>
                    @endforeach
                </select>
                <span class="text-error">{{ $errors->has('assunto_id') ? $errors->first('assunto_id') : '' }}</span>
            </div>
          </div>
          <div class="form-row mt-3">
            <div class="form-group col-md-12">
              <textarea class="form-control" rows="5" name="descricao" placeholder="Mensagem"></textarea>
              <span class="text-error">{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}</span>
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <button class="btn btn-primary" type="submit">Enviar</button>
          </div>
          Ao enviar você está aceitando a <a href="{{route('site.politica')}}">política de privacidade</a>.
        </form>

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
