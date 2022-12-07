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
                        <h1 class="text-verde">Mensagem</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        @if ($mensagem->status_id == 2)
                            <thead class="thead-secondary">
                                <tr class="text-center">
                                    <th>Nome</th>
                                    <th>Assunto</th>
                                    <th>Descrição</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-secondary font">
                                    <td>
                                        {{ $mensagem->nome }}
                                    </td>
                                    <td>
                                        {{ $mensagem->assunto->descricao }}
                                    </td>
                                    <td>
                                        {{ $mensagem->descricao }}
                                    </td>
                                    <td>
                                        {{ $mensagem->telefone }}
                                    </td>
                                    <td>
                                        {{ $mensagem->email }}
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#myModal{{$mensagem->id}}"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
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
                            </tbody>
                        @else
                            <thead class="thead-secondary">
                                <tr class="text-center">
                                    <th>Nome</th>
                                    <th>Assunto</th>
                                    <th>Descrição</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Concluir</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-secondary font">
                                    <td>
                                        {{ $mensagem->nome }}
                                    </td>
                                    <td>
                                        {{ $mensagem->assunto->descricao }}
                                    </td>
                                    <td>
                                        {{ $mensagem->descricao }}
                                    </td>
                                    <td>
                                        {{ $mensagem->telefone }}
                                    </td>
                                    <td>
                                        {{ $mensagem->email }}
                                    </td>
                                    <td>
                                        <a href="{{ route('app.mensagem.concluir', $mensagem->id) }}"> <i class="fas fa-check-square text-success"></i></a>
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#myModal{{$mensagem->id}}"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
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
                            </tbody>
                        @endif
                    </table>

                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <span class="float-right"><a href="{{ route('app.mensagem') }}"
                                        class="btn btn-amarelo mt-4 mb-3">Voltar</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
