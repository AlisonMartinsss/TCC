@extends('app.layouts.basico')

@section('titulo', 'Mensagens')

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
                            <li class="nav-item">
                                <a href="{{ route('app.imovel') }}" class="nav-link">Imóveis</a>
                            </li>
                            <li class="nav-item active">
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
                        <h1 class="text-verde">Mensagens</h1>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="text-center mt-5 mb-3">
                        <h3 class="text-verde">Novas</h3>
                    </div>
                    @if ($mensagens->count() == 0 || $pendentes == 0)
                        <tr class="text-center" style="font-size: 13px">
                            <div class="card bg-light my-3">
                                <div class="card-body">
                                    <p class="card-text text-center">Nenhuma mensagem nova</p>
                                </div>
                            </div>
                        </tr>
                    @else
                        @foreach ($mensagens as $mensagem)
                            @if ($mensagem->status_id == 1)
                                <div class="card bg-light my-3">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{$mensagem->nome}}
                                            <span class="float-right pt-4">
                                                <a href="{{ route('app.mensagem.exibir', $mensagem->id) }}"><i class="fas fa-search text-info mr-2"></i></a>
                                                <a href="{{ route('app.mensagem.concluir', $mensagem->id) }}"> <i class="fas fa-check-square text-success mr-2"></i></a>
                                                <a href="" data-toggle="modal" data-target="#myModal{{$mensagem->id}}"><i class="fas fa-trash text-danger"></i></a>
                                                <form id="deleteForm{{$mensagem->id}}" method="GET" action="{{ route('app.mensagem.excluir', $mensagem->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal" id="myModal{{$mensagem->id}}">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h4 class="modal-title">Confirmação</h4>
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                              <p class="text-center">Confirmar exclusão do registro?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                              <button type="submit" class="btn btn-danger">Excluir</button>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                </form>
                                            </span>

                                        </h5>
                                        <h6 class="card-subtitle mb-1">{{$mensagem->assunto->descricao}}</h6>

                                        <span class="card-text">{{$mensagem->descricao}}</span><br>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="text-center mt-5 mb-3">
                        <h3 class="text-verde">Visualizadas</h3>
                    </div>
                    @if ($mensagens->count() == 0 || $concluido == 0)
                        <tr class="text-center" style="font-size: 13px">
                            <div class="card bg-light my-3">
                                <div class="card-body">
                                    <p class="card-text text-center">Nenhuma mensagem visualizada</p>
                                </div>
                            </div>
                        </tr>
                    @else
                        @foreach ($mensagens as $mensagem)
                            @if ($mensagem->status_id == 2)
                                <div class="card bg-light my-3">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{$mensagem->nome}}
                                            <span class="float-right pt-4">
                                                <a href="{{ route('app.mensagem.exibir', $mensagem->id) }}"><i class="fas fa-search text-info mr-2"></i></a>
                                                <a href="" data-toggle="modal" data-target="#myModal{{$mensagem->id}}"><i class="fas fa-trash text-danger"></i></a>
                                                <form id="deleteForm{{$mensagem->id}}" method="GET" action="{{ route('app.mensagem.excluir', $mensagem->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal" id="myModal{{$mensagem->id}}">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h4 class="modal-title">Confirmação</h4>
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                              <p class="text-center">Confirmar exclusão do registro?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                              <button type="submit" class="btn btn-danger">Excluir</button>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                </form>
                                            </span>

                                        </h5>
                                        <h6 class="card-subtitle mb-1">{{$mensagem->assunto->descricao}}</h6>

                                        <span class="card-text">{{$mensagem->descricao}}</span><br>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <span class="float-right"><a href="{{ route('app.home') }}"
                                class="btn btn-amarelo mt-4 mb-3">Voltar</a></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
