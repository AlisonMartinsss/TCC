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
                        @if (URL::previous() == 'http://localhost:8000/app/tarefa')
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
                        @else
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
                        @endif
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
                            <h1 class="text-verde">Edição de Tarefas</h1>
                        @else
                            <h1 class="text-verde">Cadastro de Tarefas</h1>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 bg-cinzaaa">
                    <form action="{{ route('app.tarefa.salvar') }}" method="post" class="mt-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $tarefa->id ?? '' }}">
                        <input type="hidden" name="user_id" value="{{$usuario}}">
                        <input type="hidden" name="contato_id" value="{{$contato}}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <input type="text" name="assunto" class="form-control" placeholder="Assunto" value="{{ $tarefa->assunto ?? old('assunto') }}">
                              <span class="text-error">{{ $errors->has('assunto') ? $errors->first('assunto') : '' }}</span>
                            </div>
                            <div class="form-group col-md-3">
                              <input type="date" name="data" class="form-control" value="{{ $tarefa->data ?? old('data') }}">
                              <span class="text-error">{{ $errors->has('data') ? $errors->first('data') : '' }}</span>
                            </div>
                            <div class="form-group col-md-3">
                              <input type="time" name="hora" class="form-control" value="{{ $tarefa->hora ?? old('hora') }}">
                              <span class="text-error">{{ $errors->has('hora') ? $errors->first('hora') : '' }}</span>
                            </div>
                          </div>
                          <div class="form-row">
                            <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição">{{ $tarefa->descricao ?? old('descricao') }}</textarea>
                          </div>
                          <span class="text-error">{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}</span>


                        <div class="form-row d-flex justify-content-center mt-2">
                            <div class="form-group col-md-2">
                                @if (URL::previous() == 'http://localhost:8000/app/tarefa')
                                    <a href="{{ route('app.tarefa') }}" class="btn btn-danger">Cancelar</a>
                                @else
                                    <a href="{{ route('app.contato.exibir', $contato) }}" class="btn btn-danger">Cancelar</a>
                                @endif
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-verde" type="submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                @if (URL::previous() == 'http://localhost:8000/app/tarefa')
                    <a href="{{ route('app.tarefa') }}" class="btn btn-amarelo mt-4 mb-3">Voltar</a>
                @else
                    <a href="{{ route('app.contato.exibir', $contato) }}" class="btn btn-amarelo mt-4 mb-3">Voltar</a>
                @endif
            </div>
        </div>
    </section>
@endsection
