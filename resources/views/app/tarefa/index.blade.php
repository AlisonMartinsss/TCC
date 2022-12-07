@extends('app.layouts.basico')

@section('titulo', 'Tarefas')

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
                            <li class="nav-item">
                                <a href="{{ route('app.mensagem') }}" class="nav-link">Mensagens</a>
                            </li>
                        @endif

                        <li class="nav-item active">
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
        <div class="container-fluid">
            <h1 class="text-center text-verde mt-5 mb-5">Tarefas Pendentes</h1>
            <table class="table table-hover mt-4 bd-lateral bd-baixo">
                <thead>
                    <tr class="text-center">
                        <th>CONTATO</th>
                        <th>ASSUNTO</th>
                        <th>DESCRIÇÃO</th>
                        <th>DATA E HORA</th>
                        <th>OPÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tarefas->count() == 0 || $pendentes == 0)
                        <tr class="text-center" style="font-size: 13px">
                            <td colspan="5">Nenhuma tarefa pendente</td>
                        </tr>
                    @else
                        @foreach ($tarefas as $tarefa)
                            @if ($tarefa->user->email == $_SESSION['email'] && $tarefa->status_id == 1)
                                @if (strtotime($tarefa->data) <= $dataAtual && strtotime(date('H:i', strtotime($tarefa->hora))) < $horaAtual)
                                    <tr class="text-center" style="font-size: 13px; color: red">
                                @else
                                    <tr class="text-center" style="font-size: 13px">
                                @endif
                                <td>
                                    {{ $tarefa->contato->nome }}
                                </td>
                                <td>
                                    {{ $tarefa->assunto }}
                                </td>
                                <td>
                                    {{ $tarefa->descricao }}
                                </td>
                                <td>
                                    {{ date('d/m/Y', strtotime($tarefa->data)) . ' às ' . date('H:i', strtotime($tarefa->hora)) }}
                                </td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{ route('app.tarefa.concluir', $tarefa->id) }}"><i class="fas fa-check-square text-success"></i></a>
                                    <a href="{{ route('app.tarefa.editar', $tarefa->id) }}"><i class="fas fa-edit text-info"></i></a>
                                    <a href="" data-toggle="modal" data-target="#myModal{{$tarefa->id}}"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                                </tr>
                                <form id="deleteForm{{$tarefa->id}}" method="GET" action="{{ route('app.tarefa.excluir', $tarefa->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal" id="myModal{{$tarefa->id}}">
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
                            @endif
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <h1 class="text-center text-verde mt-5 mb-5">Tarefas Concluídas</h1>
            <table class="table table-hover mt-4 bd-lateral bd-baixo">
                <thead>
                    <tr class="text-center">
                        <th>CONTATO</th>
                        <th>ASSUNTO</th>
                        <th>DESCRIÇÃO</th>
                        <th>DATA E HORA</th>
                        <th>OPÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tarefas->count() == 0 || $concluido == 0)
                        <tr class="text-center" style="font-size: 13px">
                            <td colspan="5">Nenhuma tarefa concluída</td>
                        </tr>
                    @else
                        @foreach ($tarefas as $tarefa)
                            @if ($tarefa->user->email == $_SESSION['email'] && $tarefa->status_id == 2)
                                <tr class="text-center" style="font-size: 13px">
                                    <td>
                                        {{ $tarefa->contato->nome }}
                                    </td>
                                    <td>
                                        {{ $tarefa->assunto }}
                                    </td>
                                    <td>
                                        {{ $tarefa->descricao }}
                                    </td>
                                    <td>
                                        {{ date('d/m/Y', strtotime($tarefa->data)) . ' às ' . date('H:i', strtotime($tarefa->hora)) }}
                                    </td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#myModal{{$tarefa->id}}"><i class="fas fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                                <form id="deleteForm{{$tarefa->id}}" method="GET" action="{{ route('app.tarefa.excluir', $tarefa->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal" id="myModal{{$tarefa->id}}">
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
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </section>
@endsection
