@extends('app.layouts.basico')

@section('titulo', 'Contatos')

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
                        <h1 class="text-verde">Contatos</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead class="thead-secondary">
                            <tr class="text-center">
                                <th>Nome</th>
                                <th>Interesse</th>
                                <th>Situação</th>
                                <th>Visualizar</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($qtdContatos == 0)
                                <tr class="table-secondary font">
                                    <td colspan="6">Nenhum contato cadastrado</td>
                                </tr>
                            @else
                                @foreach ($contatos as $contato)
                                    <tr class="table-secondary font">
                                        <td>
                                            {{ $contato->nome }}
                                        </td>
                                        <td>
                                            {{ $contato->tipo->descricao }} - {{ $contato->localizacao->bairro }}, {{ $contato->localizacao->cidade }}/SC
                                        </td>
                                        <td>
                                            {{ $contato->situacao->descricao }}
                                        </td>
                                        <td>
                                            <a href="{{ route('app.contato.exibir', $contato->id) }}"><i
                                                    class="fas fa-search text-dark"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('app.contato.editar', $contato->id) }}"> <i class="fas fa-edit text-dark"></i></a>
                                        </td>
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#myModal{{$contato->id}}"> <i class="fas fa-trash text-dark"></i></a>
                                        </td>
                                    </tr>
                                    <form id="deleteForm{{$contato->id}}" method="GET" action="{{ route('app.contato.excluir', $contato->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <div class="modal" id="myModal{{$contato->id}}">
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
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{$contatos->links()}}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <span class="float-right"><a href="{{ route('app.contato') }}"
                                        class="btn btn-amarelo mt-4 mb-3">Voltar</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
