@extends('app.layouts.basico')

@section('titulo', 'Contatos')

@section('conteudo')

    <header class="pt-3 pb-5">
        <nav class="navbar navbar-expand-sm navbar-dark">
          <div class="container">
            <a href="{{route('app.home')}}" class="navbar-brand">
              <img src="{{asset('img/liberta.jpg')}}" width="142">
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
        <div class="container bg-cinzaaa mt-5">
            <div class="row py-3">
                <div class="col-md-2">
                    <h4>{{ $contato->id }}</h4>
                </div>
                <div class="col-md-8">
                    <h4>{{ $contato->nome }}</h4>
                </div>
                <div class="col-md-2 d-flex justify-content-end">
                    <a href="{{ route('app.contato.editar', $contato->id) }}"><i class="fas fa-edit text-body"></i></a>
                    <a href="" data-toggle="modal" data-target="#myModal{{$contato->id}}"> <i class="fas fa-trash text-body mx-3"></i></a>
                    <form id="deleteForm" method="GET" action="{{ route('app.contato.excluir', $contato->id) }}">
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
                </div>
            </div>

            <div class="row py-3" style="border-top: 1px solid #dee2e6;">
                <div class="col-md-2">
                    <h6>Situação</h6>
                    {{ $contato->situacao->descricao }}
                </div>
                <div class="col-md-2">
                    <h6>Criação do contato</h6>
                    {{ $contato->created_at->format("d/m/Y"). ' às '. $contato->created_at->format("H:i") }}
                </div>
                <div class="col-md-8">
                    <h6>Responsável</h6>
                    {{ $contato->user->nome }}
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container my-4">

            <div class="row">
                <div class="col-md-12 bg-cinzaaa">
                    Informações
                </div>
                <div class="col-md-12 pb-3 bd-lateral bd-baixo">
                    <div class="mx-2">
                        <form>
                            <div class="form-row mt-3">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" value="{{ $contato->nome }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control telefone" value="{{ $contato->telefone }}"
                                        readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text spanA"><a href="https://wa.me/{{ $contato->telefone }}" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a></span>
                                    </div>
                                    <input type="text" class="form-control ml-2" value="{{ $contato->email }}"
                                        readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text spanA"><a href="mailto:{{ $contato->email }}" target="_blank" rel="noopener noreferrer"><i class="fas fa-inbox"></i></a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" value="{{$contato->fonte->descricao }}"
                                        readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control"
                                        value="{{ $contato->localizacao->cidade }} - {{ $contato->localizacao->bairro }}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control"
                                    value="{{ $contato->tipo->descricao }}" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-5 bg-cinzaaa">
                    Anotações
                </div>
                <div class="col-md-12 bd-lateral bd-baixo">
                    @if ($qtdAnotacoes == 0)
                        <div class="card bg-light my-3">
                            <div class="card-body">
                                <p class="card-text text-center">Nenhuma anotação cadastrada</p>
                            </div>
                        </div>
                    @else
                        @foreach ($anotacoes as $anotacao)
                            @if ($anotacao->contato->id == $contato->id)
                                <div class="card bg-light my-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Anotação de {{$anotacao->user->nome}}</h5>
                                        @if ($anotacao->user->email == $_SESSION['email'])
                                            <span class="float-right">
                                                <a href="" data-toggle="modal" data-target="#myModal{{$anotacao->id}}"><i class="fas fa-trash text-danger"></i></a>
                                                    <form id="deleteForm{{$anotacao->id}}" method="GET" action="{{ route('app.anotacao.excluir', $anotacao->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal" id="myModal{{$anotacao->id}}">
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
                                        @endif
                                        <p class="card-subtitle text-muted mb-2">{{ $anotacao->created_at->format("d/m/Y"). ' às '. $anotacao->created_at->format("H:i") }}</p>
                                        <p class="card-text">{{$anotacao->descricao}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    <div class="d-flex justify-content-center">
                        <a href="{{route('app.anotacao.cadastrar', $contato->id)}}" class="btn btn-secondary mb-3">Cadastrar Anotação</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 bg-cinzaaa mt-5">
                    Tarefas
                </div>
                <div class="col-md-12 bd-lateral bd-baixo">

                    @if ($tarefas->count() == 0 || $qtdTarefas == 0)
                        <div class="card bg-light my-3">
                            <div class="card-body">
                                <p class="card-text text-center">Nenhuma tarefa cadastrada</p>
                            </div>
                        </div>
                    @else
                        @foreach ($tarefas as $tarefa)
                            @if ($tarefa->user->email == $_SESSION['email'] && $tarefa->contato->id == $contato->id && $tarefa->status_id == 1)
                                @if (strtotime($tarefa->data) <= $dataAtual && strtotime(date('H:i', strtotime($tarefa->hora))) < $horaAtual)
                                    <div class="card bg-light text-danger my-3">
                                @else
                                    <div class="card bg-light my-3">
                                @endif
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{$tarefa->assunto}}
                                                <span class="float-right pt-4">
                                                    <a href="{{ route('app.tarefa.concluir', $tarefa->id) }}"><i class="fas fa-check-square text-success"></i></a>
                                                    <a href="{{ route('app.tarefa.editar', $tarefa->id, $contato->id) }}"><i class="fas fa-edit text-info"></i></a>
                                                    <a href="" data-toggle="modal" data-target="#myModal{{$tarefa->id}}"><i class="fas fa-trash text-danger"></i></a>
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
                                                </span>

                                        </h5>
                                        <h6 class="card-subtitle mb-1">{{ date('d/m/Y', strtotime($tarefa->data)) . ' às ' . date('H:i', strtotime($tarefa->hora)) }}</h6>

                                        <p class="card-text">{{$tarefa->descricao}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @foreach ($tarefas as $tarefa)
                            @if ($tarefa->user->email == $_SESSION['email'] && $tarefa->contato->id == $contato->id && $tarefa->status_id == 2)
                                <div class="card bg-light my-3">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{$tarefa->assunto}}
                                            <span class="float-right pt-4 pr-4">
                                                <a href="" data-toggle="modal" data-target="#myModal{{$tarefa->id}}"><i class="fas fa-trash text-danger"></i></a>
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
                                            </span>
                                        </h5>
                                        <h6 class="card-subtitle mb-1">{{ date('d/m/Y', strtotime($tarefa->data)) . ' às ' . date('H:i', strtotime($tarefa->hora)) }}</h6>
                                        <p class="card-text">{{$tarefa->descricao}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif


                    <div class="d-flex justify-content-center">
                        <a href="{{route('app.tarefa.cadastrar', $contato->id)}}" class="btn btn-secondary mb-3">Cadastrar Tarefa</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('app.contato.consultar') }}" class="btn btn-amarelo mt-4 mb-3">Voltar</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.telefone').mask('(99) 9 9999-9999');
        });
    </script>
@endsection
