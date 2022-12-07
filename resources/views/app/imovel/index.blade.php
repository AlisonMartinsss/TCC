@extends('app.layouts.basico')

@section('titulo', 'Imóveis')

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
                        <li class="nav-item">
                            <a href="{{ route('app.home') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('app.contato') }}" class="nav-link">Contatos</a>
                        </li>
                        @if ($_SESSION['funcao_id'] == 1)
                            <li class="nav-item active">
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="h1-cadastrar" class="text-center mt-5 mb-3">
                        <h1>Imóveis</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 bg-cinzaaa">

                    <form action="{{ route('app.imovel.consultar') }}" method="POST">
                        @csrf
                        <div class="form-row mt-3">
                            <div class="form-group col-md-2">
                                <input type="number" name="id" class="form-control" placeholder="Id">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="nome" class="form-control" placeholder="Nome do Imóvel">
                            </div>
                            <div class="form-group col-md-4">
                                <input type="number" name="valor" class="form-control" placeholder="Valor">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <select class="custom-select" name="tipo_id">
                                    <option value="">Tipo</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="custom-select" name="localizacao_id">
                                    <option value="">Localização</option>
                                    @foreach ($localizacoes as $localizacao)
                                        <option value="{{ $localizacao->id }}">{{ $localizacao->cidade }} - {{$localizacao->bairro}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select class="custom-select" name="estagio_id">
                                    <option value="">Estágio da Obra</option>
                                    @foreach ($estagios as $estagio)
                                        <option value="{{ $estagio->id }}">{{ $estagio->descricao }}</span> </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row d-flex justify-content-center mt-2">
                            <div class="form-group col-md-2">
                                <button class="btn btn-verde">Procurar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <a href="{{ route('app.imovel.cadastrar') }}" class="btn btn-secondary mt-4 mb-3">Cadastrar Imóveis</a>
                    <span class="float-right"><a href="{{ route('app.home') }}" class="btn btn-amarelo mt-4 mb-3">Voltar</a></span>
                </div>
            </div>
        </div>
    </section>
@endsection
