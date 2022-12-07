@extends('app.layouts.basico')

@section('titulo', 'CRM')

@section('conteudo')

    <header class="pt-3 pb-5">
        <nav class="navbar navbar-expand-sm navbar-dark">
            <div class="container">
                <a href="{{ route('app.home') }}" class="navbar-brand">
                    <img src="{{ asset('img/liberta.jpg') }}" width="142">
                </a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-principal">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav-principal">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a href="{{ route('app.home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('app.contato') }}" class="nav-link">Contatos</a>
                        </li>

                        @if ($_SESSION['funcao_id'] == 1)
                            <li class="nav-item">
                                <a href="{{ route('app.imovel') }}" class="nav-link">Imóveis</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('app.mensagem') }}" class="nav-link">Mensagens</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('app.tarefa') }}" class="nav-link">Tarefas</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('app.perfil') }}" class="nav-link">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('app.sair') }}" class="nav-link">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="container pt-4">
            @if (session('status'))
                <div class="alert alert-danger text-center">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="row m-3">

                <div class="col-md-3">
                    <h5 class="h5menor">Sem Contato</h5>
                    <h6 class="h6pequeno">
                        @if ($semContato == 1)
                        {{$semContato}} imóvel encontrado
                    @else
                        {{$semContato}} imóveis encontrados
                    @endif
                    </h6>

                    @foreach ($contatos as $contato)
                        @if ($contato->situacao_id == 1)
                            <div id="linkSemContato" class="p-3 bg-cinzaaa mb-3 selecionar">
                                <a href="{{route('app.contato.exibir', $contato->id)}}" class="todaDiv">
                                    <strong>{{ $contato->nome }}</strong><br>
                                    {{ $contato->tipo->descricao }} - {{ $contato->localizacao->bairro }},{{ $contato->localizacao->cidade }}/SC
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>

                <div class="col-md-3">
                    <h5 class="h5menor">Contato Inicial</h5>
                    <h6 class="h6pequeno">
                        @if ($contatoInicial == 1)
                        {{$contatoInicial}} imóvel encontrado
                    @else
                        {{$contatoInicial}} imóveis encontrados
                    @endif
                    </h6>

                    @foreach ($contatos as $contato)

                        @if ($contato->situacao_id == 2)
                        <div id="linkSemContato" class="p-3 bg-cinzaaa mb-3 selecionar">
                            <a href="{{route('app.contato.exibir', $contato->id)}}" class="todaDiv">
                                <strong>{{ $contato->nome }}</strong><br>
                                {{ $contato->tipo->descricao }} - {{ $contato->localizacao->bairro }},
                                {{ $contato->localizacao->cidade }}/SC
                            </a>
                        </div>
                        @endif

                    @endforeach
                </div>

                    <div class="col-md-3">
                        <h5 class="h5menor">Proposta Enviada</h5>
                        <h6 class="h6pequeno">
                            @if ($propostaEnviada == 1)
                        {{$propostaEnviada}} imóvel encontrado
                    @else
                        {{$propostaEnviada}} imóveis encontrados
                    @endif
                        </h6>

                        @foreach ($contatos as $contato)
                        @if ($contato->situacao_id == 3)
                        <div id="linkSemContato" class="p-3 bg-cinzaaa mb-3 selecionar">
                            <a href="{{route('app.contato.exibir', $contato->id)}}" class="todaDiv">
                                <strong>{{ $contato->nome }}</strong><br>
                                {{ $contato->tipo->descricao }} - {{ $contato->localizacao->bairro }},
                                {{ $contato->localizacao->cidade }}/SC
                            </a>
                        </div>
                        @endif
                        @endforeach

                    </div>
                    <div class="col-md-3">
                        <h5 class="h5menor">Contrato Assinado</h5>
                        <h6 class="h6pequeno">
                            @if ($contratoAssinado == 1)
                        {{$contratoAssinado}} imóvel encontrado
                    @else
                        {{$contratoAssinado}} imóveis encontrados
                    @endif
                        </h6>

                        @foreach ($contatos as $contato)
                        @if ($contato->situacao_id == 4)
                        <div id="linkSemContato" class="p-3 bg-cinzaaa mb-3 selecionar">
                            <a href="{{route('app.contato.exibir', $contato->id)}}" class="todaDiv">
                                <strong>{{ $contato->nome }}</strong><br>
                                {{ $contato->tipo->descricao }} - {{ $contato->localizacao->bairro }},
                                {{ $contato->localizacao->cidade }}/SC
                            </a>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>
    </section>
@endsection
