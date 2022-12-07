@extends('app.layouts.basico')

@section('titulo', 'Imóvel')

@section('conteudo')


    <header class="pt-3 pb-5">
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.index') }}">Home</a>
                        </li>
                        <li class="nav-item active">
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

    <section>
        <div class="container pt-3">
            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </section>

    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-9 p-4">
                    <div class="mt-3">
                        <span class="textoImovelTitulo">{{ $imovel->tipo->descricao }} - {{ $imovel->nome }}</span>
                        <br>
                        <span class="textoImovelSubtitulo">{{ $imovel->localizacao->bairro }},
                            {{ $imovel->localizacao->cidade }}/SC </span>
                    </div>
                </div>

                <div class="col-md-3 p-4">
                    <div class="textoCompart">Compartilhe</div>
                    <div class="iconesCompart">
                        <a href=""><img src="{{ asset('img/whatsapp.png') }}" width="30px" height="30px"></a>
                        <a href=""><img src="{{ asset('img/facebook.png') }}" width="30px" height="30px"></a>
                        <a href=""><img src="{{ asset('img/instagram.png') }}" width="30px" height="30px"></a>
                        <a href=""><img src="{{ asset('img/telegram.png') }}" width="30px" height="30px"></a>
                        <a href=""><img src="{{ asset('img/twitter.png') }}" width="30px" height="30px"></a>
                        <a href=""><img src="{{ asset('img/mail.png') }}" width="30px" height="30px"></a>
                    </div>
                    <div class="textoCod">Código do imóvel #{{ $imovel->id }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div id="demo" class="carousel slide py-3" data-ride="carousel">

                        <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            @for ($i = 1; $i <= count($imovel->fotos); $i++)
                                <li data-target="#demo" data-slide-to="{{ $i }}"></li>
                            @endfor
                        </ul>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('storage/image/' . $imovel->foto_principal) }}" width="100%" height="500px">
                              </div>
                              @for ($i = 0; $i < count($imovel->fotos); $i++)
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="{{ asset('storage/image/' . $imovel->fotos[$i]) }}" width="100%" height="500px">
                                </div>
                            @endfor
                        </div>

                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column pt-3">

                        <div class="bd-lateral bd-baixo bd-cima">
                            <div class="p-3">
                                <h6>Valores do imóvel</h6>
                                <i class="fas fa-dollar-sign mr-1"></i>Valor<span
                                    class="float-right">R${{ number_format($imovel->valor, 2, ',', '.') }}</span><br>
                                <i class="fas fa-hand-holding-usd mr-1"></i>Entrada<span
                                    class="float-right">{{ $imovel->entrada_minima_porcentagem }}%</span>
                            </div>
                        </div>
                        <div class="bd-lateral bd-baixo">
                            <div class="p-3">
                                <h6>Características</h6>
                                <i class="fas fa-hashtag mr-1"></i>Código<span
                                    class="float-right">{{ $imovel->id }}</span><br>
                                <i class="fas fa-building mr-1"></i>Tipo de imóvel<span
                                    class="float-right">{{ $imovel->tipo->descricao }}</span><br>
                                <i class="fas fa-bed mr-1"></i>Quarto(s)<span
                                    class="float-right">{{ $imovel->dormitorio->quantidade }}</span><br>
                                <i class="fas fa-shower mr-1"></i>Banheiro(s)<span
                                    class="float-right">{{ $imovel->banheiro->quantidade }}</span><br>
                                <i class="fas fa-car mr-1"></i>Vaga(s)<span
                                    class="float-right">{{ $imovel->vaga->quantidade }}</span>
                            </div>
                        </div>
                        <div class="bd-lateral bd-baixo">
                            <div class="p-3">
                                <h6>Medidas</h6>
                                <i class="fas fa-arrows-alt mr-1"></i>Área Útil<span
                                    class="float-right">{{ $imovel->metragem_util }}m²</span><br>
                                <i class="fas fa-object-group mr-1"></i>Área Total<span
                                    class="float-right">{{ $imovel->metragem_total }}m²</span>
                            </div>
                        </div>
                        <div class="bd-lateral bd-baixo">
                            <div class="p-3">
                                <h6>Gostou?</h6>
                                <i class="fas fa-print mr-1 mb-3"></i>Imprimir<span class="float-right"><i
                                        class="far fa-hand-pointer fa-lg" style="cursor: pointer;"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 p-4">
                    <h6>O imóvel</h6>
                    <p>{{ $imovel->descricao }}</p><br>
                    <div class="row">
                        <div class="col-6">
                            <h6>DETALHES:</h6>
                            @for ($i = 0; $i < count($imovel->detalhes); $i++)
                                <img src="{{ asset('img/setaDir.png') }}" class="mr-2" width="10px"
                                    height="10px">{{ $imovel->detalhes[$i] }};<br>
                            @endfor
                        </div>
                        <div class="col-6 float-end">
                            <h6>CARACTERÍSTICAS:</h6>
                            @for ($i = 0; $i < count($imovel->caracteristicas); $i++)
                                <img src="{{ asset('img/setaDir.png') }}" class="mr-2" width="10px"
                                    height="10px">{{ $imovel->caracteristicas[$i] }};<br>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-md-3 p-4">
                    <div>
                        <h6>Localização</h6>
                    </div>
                    <div>
                        <iframe src="{{ $imovel->url_mapa }}" width="240" height="200" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-9 p-4">
                    <h6>Agende uma visita com nossos corretores:</h6>
                    <p>Pelo telefone (47) 3333-3333 ou pelo WhatsApp (47) 9 9999-9999</p>
                </div>
            </div>
        </div>
    </section>
    <section class="cadastrar">
        <div class="container bd-todos bg-verde">
            <h3 class="pt-3 text-center">Receba mais informações sobre esse imóvel</h3>
            <p class="text-center">Preencha o formulário abaixo para conversar com a Libertá Negócios Imobiliários.</p>
            <form action="{{ route('site.imovel') }}" method="POST">
                @csrf
                <input type="hidden" name="tipo_id" class="form-control" value="{{ $imovel->tipo_id }}">
                <input type="hidden" name="localizacao_id" class="form-control" value="{{ $imovel->localizacao_id }}">
                <input type="hidden" name="user_id" class="form-control" value="{{ $usuario }}">

                <div class="form-row mt-1">
                    <div class="form-group col-md-4">
                        <input type="text" name="nome" class="form-control" placeholder="Nome Completo">
                        <span class="text-error">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="email" class="form-control" placeholder="E-mail">
                        <span class="text-error">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="tel" name="telefone" class="form-control" placeholder="Telefone">
                        <span class="text-error">{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <span>
                        <button class="btn btn-primary my-4 px-3 py-2" type="submit">Cadastrar Interesse</button>
                    </span>
                </div>
            </form>
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
                    <a href="#"><img src="{{ asset('img/instagram.png') }}" width="50px" height="50px"></a>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection
