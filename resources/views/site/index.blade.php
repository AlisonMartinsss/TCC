@extends('app.layouts.basico')

@section('titulo', 'Home')

@section('conteudo')

    <header class="pt-3">
        <nav class="navbar navbar-expand-sm navbar-dark">
            <div class="container">
                <a href="{{ route('site.index') }}" class="navbar-brand">
                    <img src="{{ asset('img/liberta.jpg') }}" width="142">
                </a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-principal">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav-principal">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('site.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.busca') }}">Imóveis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.sobre') }}">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.mensagem') }}">Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <h1 class="display-4 mt-1 text-center">Encontre o seu imóvel</h1>
                    <p class="text-center">
                        Com a Libertá você tem a possibilidade de conquistar o seu sonho.
                    </p>

                    <form action="{{route('site.busca')}}" method="post" class="my-5">
                        @csrf
                        <div class="input-group mt-3 mb-3">
                            <input type="text" class="form-control border-right-0" name="nome" placeholder="Digite a cidade ou bairro...">
                          <div class="input-group-prepend">
                            <select name="tipo_id" class="custom-select border-right-0 rounded-0">
                                <option value="">Tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">
                                        {{ $tipo->descricao }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                          <div class="input-group-prepend">
                            <select name="localizacao_id" class="custom-select border-right-0 rounded-0">
                                <option value="">Localização</option>
                                @foreach ($localizacoes as $localizacao)
                                    <option value="{{ $localizacao->id }}">
                                        {{ $localizacao->cidade }} - {{ $localizacao->bairro }}
                                    </option>
                                @endforeach
                            </select>
                          </div>
                          <div class="input-group-prepend">
                          <button class="btn btn-primary rounded-right" type="submit">Buscar</button>
                        </div>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </section>

    <section id="destaque">
        <div class="container">
            <h2 class="text-center text-verde pt-5 pb-3">EMPREENDIMENTOS EM DESTAQUE</h2>
            @if (count($destaques) == 0)
                <div class="bg-verde" style="border-radius:10px">
                    <h4 class="text-center text-white py-3">Nenhum imóvel em destaque no momento</h4>
                </div>
            @else
                <div class="row">
                    <div class="col-md-6">

                        @foreach ($destaques->take(1) as $destaque)
                            <a href="{{route('site.imovel.detalhe', $destaque->id)}}">
                                <div id="destaque1" class="card cardGrande">
                                    <img class="card-img-top" src="{{asset('storage/image/'.$destaque->foto_principal)}}">
                                    <div class="fundoComOpacidade p-2">
                                        <div class="infosDestaque">
                                            <span class="float-left">
                                                <h6 class="upper"><small>bairro {{$destaque->localizacao->bairro}}, {{$destaque->localizacao->cidade}}/SC</small><br>
                                                    {{$destaque->nome}}</h6>
                                            </span>
                                            <span class="float-right pt-2">
                                                <b>R${{number_format($destaque->valor, 2, ',', '.')}}</b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        @foreach ($destaques->skip(1)->take(1) as $destaque)
                            <a href="{{route('site.imovel.detalhe', $destaque->id)}}">
                                <div id="destaque2" class="card cardGrande escondido">
                                    <img class="card-img-top" src="{{asset('storage/image/'.$destaque->foto_principal)}}">

                                    <div class="fundoComOpacidade p-2">
                                        <div class="infosDestaque">
                                            <span class="float-left">
                                                <h6 class="upper"><small>bairro {{$destaque->localizacao->bairro}}, {{$destaque->localizacao->cidade}}/SC</small><br>
                                                    {{$destaque->nome}}</h6>
                                            </span>
                                            <span class="float-right pt-2">
                                                <b>R${{number_format($destaque->valor, 2, ',', '.')}}</b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            @foreach ($destaques->take(1) as $destaque)
                                    <div id="caixa1" class="mt-4 p-2 caixa caixaSelecionada">
                                        <h6>{{$destaque->nome}} <small>- bairro {{$destaque->localizacao->bairro}}, {{$destaque->localizacao->cidade}}/SC</small></h6>
                                        <p class="text-center">
                                            {{implode(' | ',$destaque->detalhes)}}
                                            <br>
                                            <span class="text-center">{{$destaque->metragem_total}}m² de área total</span>
                                        </p>
                                    </div>
                            @endforeach

                            @foreach ($destaques->skip(1)->take(1) as $destaque)
                                    <div id="caixa2" class="mt-4 p-2 caixa">
                                        <h6>{{$destaque->nome}} <small>- bairro {{$destaque->localizacao->bairro}}, {{$destaque->localizacao->cidade}}/SC</small></h6>
                                        <p class="text-center">
                                            {{implode(' | ',$destaque->detalhes)}}
                                            <br>
                                            <span class="text-center">{{$destaque->metragem_total}}m² de área total</span>
                                        </p>
                                    </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section>
        <div class="container">
            <h2 class="text-center text-verde pt-5 pb-3">IMÓVEIS PRONTOS PARA MORAR</h2>
                @if (count($prontos) == 0)
                    <div class="bg-verde" style="border-radius:10px">
                        <h4 class="text-center text-white py-3">Nenhum imóvel pronto no momento</h4>
                    </div>
                @else
                    <div class="row">
                        @foreach ($prontos->take(3) as $pronto)
                        <div class="col-md-4">
                            <a href="{{route('site.busca.imovel', $pronto->id)}}">
                                <div class="card cardPequeno">
                                    <img class="card-img-top" src="{{asset('storage/image/'.$pronto->foto_principal)}}">

                                    <div class="fundoComOpacidade p-2">
                                        <div class="infos">
                                            <span class="float-left">
                                                bairro {{$pronto->localizacao->bairro}}, {{$pronto->localizacao->cidade}}/SC<br>
                                                <b style="text-transform: uppercase">{{$pronto->nome}}</b>
                                            </span>
                                            <span class="float-right pt-2">
                                                <b>R${{number_format($pronto->valor, 2, ',', '.')}}</b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                @endif
        </div>
    </section>

    <footer id="acompanhe" class="mt-4">
        <div class="container">
            <div class="row p-4">
                <div class="col-md-2">
                    <a href="{{ route('site.index') }}" class="navbar-brand">
                        <img src="{{ asset('img/liberta.jpg') }}" width="142">
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
                    <a href="#"><img src="{{ asset('img/whatsapp.png') }}" width="50px" height="50px"></a>
                    <a href="#"><img src="{{ asset('img/facebook.png') }}" width="50px" height="50px"></a>
                    <a href="#"><img src="{{ asset('img/instagram.png') }}" width="50px"
                            height="50px"></a>
                    <a href="#"><img src="{{ asset('img/mail.png') }}" width="50px" height="50px"></a>
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
@section('scripts')
    <script>
        window.onload = function(){
            var destaque1 = document.getElementById("destaque1");
            var destaque2 = document.getElementById("destaque2");

            var caixa1 = document.getElementById("caixa1");
            caixa1.onclick = mostrarDestaque1;
            var caixa2 = document.getElementById("caixa2");
            caixa2.onclick = mostrarDestaque2;

            function mostrarDestaque1(){
                caixa1.classList.add("caixaSelecionada");
                caixa2.classList.remove("caixaSelecionada");
                destaque1.classList.remove("escondido");
                destaque2.classList.add("escondido")
            }

            function mostrarDestaque2(){
                caixa1.classList.remove("caixaSelecionada");
                caixa2.classList.add("caixaSelecionada");
                destaque1.classList.add("escondido");
                destaque2.classList.remove("escondido")
            }
        }
    </script>
@endsection
