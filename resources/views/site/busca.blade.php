@extends('app.layouts.basico')

@section('titulo', 'Encontre seu imóvel')

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
              <li class="nav-item active">
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

    <section id="destaquee">
      <div class="container-fluid">

        <div class="row mt-3">

          <div class="col-md-3">
            <span class="textoFiltro">Encontre seu imóvel</span>
            <div class="d-flex flex-column">

              <form action="{{route('site.busca')}}" method="POST">
                @csrf

                <div class="input-group py-2">
                  <input type="text" class="form-control" name="nome" placeholder="Busca...">
                </div>
                <div class="bd-lateral bd-baixo bd-cima">
                  <div class="p-3">
                    <h6>FINALIDADE</h6>
                    @foreach ($finalidades as $finalidade)
                        <input type="radio" value={{$finalidade->id}} name="finalidade_id">
                        <label>{{$finalidade->descricao}}</label><br>
                    @endforeach
                  </div>
                </div>

                <div class="bd-lateral bd-baixo">
                  <div class="p-3">
                    <h6>LOCALIZAÇÃO</h6>
                    @foreach ($localizacoes as $localizacao)
                        <input type="radio" value={{$localizacao->id}} name="localizacao_id">
                        <label>{{$localizacao->bairro}} - {{$localizacao->cidade}}/SC</label>
                        <br>
                    @endforeach
                  </div>
                </div>

                <div class="bd-lateral bd-baixo">
                  <div class="p-3">
                    <h6>TIPO DO IMÓVEL</h6>
                    @foreach ($tipos as $tipo)
                        <input type="radio" value={{$tipo->id}} name="tipo_id">
                        <label>{{$tipo->descricao}}</label>
                        <br>
                    @endforeach
                  </div>
                </div>

                <div class="bd-lateral bd-baixo">
                  <div class="p-3">
                    <h6>ESTADO DO IMÓVEL</h6>
                    @foreach ($estados as $estado)
                        <input type="radio" value={{$estado->id}} name="estado_id">
                        <label>{{$estado->descricao}}</label>
                        <br>
                    @endforeach
                  </div>
                </div>

                <div class="bd-lateral bd-baixo">
                  <div class="p-3">
                    <h6>ESTAGIO DA OBRA</h6>
                    @foreach ($estagios as $estagio)
                        <input type="radio" value={{$estagio->id}} name="estagio_id">
                        <label>{{$estagio->descricao}}</label>
                        <br>
                    @endforeach
                  </div>
                </div>

                <div class="bd-lateral bd-baixo">
                  <div class="p-3">
                    <h6>DORMITORIOS</h6>
                    <div class="d-flex justify-content-around">
                        @foreach ($dormitorios as $dormitorio)
                            <input type="radio" value={{$dormitorio->id}} name="dormitorio_id">{{$dormitorio->quantidade}}
                        @endforeach
                    </div>
                  </div>
                </div>

                <div class="bd-lateral bd-baixo">
                  <div class="p-3">
                    <h6>BANHEIROS</h6>
                    <div class="d-flex justify-content-around">
                        @foreach ($banheiros as $banheiro)
                            <input type="radio" value={{$banheiro->id}} name="banheiro_id">{{$banheiro->quantidade}}
                        @endforeach
                    </div>
                  </div>
                </div>

                <div class="bd-lateral bd-baixo">
                  <div class="p-3">
                    <h6>GARAGENS</h6>
                    <div class="d-flex justify-content-around">
                        @foreach ($vagas as $vaga)
                            <input type="radio" value={{$vaga->id}} name="vaga_id">{{$vaga->quantidade}}
                        @endforeach
                    </div>
                  </div>
                </div>

                <div class="input-group py-2">
                  <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                </div>

              </form>
            </div>
          </div>

          <div class="col-md-9">
            <div class="my-2 ml-2">
                <span>
                    @if (count($imoveis) == 1)
                        {{count($imoveis)}} imóvel encontrado
                    @else
                        {{count($imoveis)}} imóveis encontrados
                    @endif
                </span>
            </div>
            <div class="d-flex flex-wrap">

                @foreach ($imoveis as $imovel)
                <a href="{{route('site.busca.imovel', $imovel->id)}}">
                    <div class="card cardPequeno m-2">
                        <img class="card-img-top" src="{{asset('storage/image/'.$imovel->foto_principal)}}">
                        <div class="fundoComOpacidade p-2">
                            <div class="infos">
                                <span class="float-left">
                                    bairro {{$imovel->localizacao->bairro}}, {{$imovel->localizacao->cidade}}/SC<br>
                                    <b style="text-transform: uppercase">{{$imovel->nome}}</b><br>
                                    <span><i class="fas fa-bed fa-lg mr-1 ml-2 pt-2"></i>{{$imovel->dormitorio->quantidade}} </span>
                                    <span><i class="fas fa-shower fa-lg mr-1 ml-2"></i>{{$imovel->banheiro->quantidade}} </span>
                                    <span><i class="fas fa-car fa-lg mr-1 ml-2"></i>{{$imovel->vaga->quantidade}} </span>
                                    <span><i class="fas fa-object-group fa-lg mr-1 ml-2"></i>{{$imovel->metragem_total}}m² </span>
                                </span>
                                <span class="float-right pt-4">
                                    <b>R${{number_format($imovel->valor, 2, ',', '.')}}</b>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-9">
            <div class="d-flex justify-content-center">

            </div>
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
