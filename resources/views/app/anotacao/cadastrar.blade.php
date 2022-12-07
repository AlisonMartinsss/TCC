@extends('app.layouts.basico')

@section('titulo', 'Anotações')

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
                        <li class="nav-item active">
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center mt-5 mb-3">
                        @if (isset($tarefa->id))
                            <h1 class="text-verde">Edição de Anotações</h1>
                        @else
                            <h1 class="text-verde">Cadastro de Anotações</h1>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 bg-cinzaaa">
                    <form action="{{ route('app.anotacao.salvar') }}" method="post" class="mt-3">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$usuario}}">
                        <input type="hidden" name="contato_id" value="{{$contato}}">

                        <div class="form-row">
                            <textarea class="form-control" rows="5" placeholder="Digite sua anotação" name="descricao"></textarea>
                        </div>
                        <span class="text-error">{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}</span>

                        <div class="form-row d-flex justify-content-center mt-2">
                            <div class="form-group col-md-2">
                                <a href="{{ route('app.contato.exibir', $contato) }}" class="btn btn-danger">Cancelar</a>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-verde" type="submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('app.contato.exibir', $contato) }}" class="btn btn-amarelo mt-4 mb-3" role="button">Voltar</a>
            </div>
        </div>
    </section>
@endsection
