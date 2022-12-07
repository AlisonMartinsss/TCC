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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center mt-5 mb-3">
                        @if (isset($contato->id))
                            <h1 class="text-verde">Edição de Contatos</h1>
                        @else
                            <h1 class="text-verde">Cadastro de Contatos</h1>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 bg-cinzaaa">
                    <form action="{{ route('app.contato.cadastrar') }}" method="post" class="mt-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $contato->id ?? '' }}">
                        <input type="hidden" name="user_id" value=" @if(isset($contato->id)) {{$contato->user_id}} @else {{$usuario}}  @endif ">

                        Informações
                        <div class="form-row">

                            <div class="form-group col-md-8">
                                <input type="text" value="{{ $contato->nome ?? old('nome') }}" name="nome"
                                    class="form-control" placeholder="Nome do Contato">
                                <span class="text-error">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
                            </div>


                            <div class="form-group col-md-4">
                                <select class="custom-select" name="situacao_id">
                                    <option value="">Situação do contato</option>
                                    @foreach ($situacoes as $situacao)
                                        <option value="{{ $situacao->id }}" @if(isset($contato->id)) {{ old('situacao_id', $contato->situacao_id) == $situacao->id ? 'selected' : '' }} @endif>
                                            {{ $situacao->descricao }}</option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('situacao_id') ? $errors->first('situacao_id') : '' }}</span>
                            </div>


                        </div>

                        Contato
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <input type="tel" name="telefone" class="form-control mb-1" placeholder="Número" value="{{ $contato->telefone ?? old('telefone') }}">
                                <span class="text-error">{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</span>
                            </div>


                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <input type="text" name="email" class="form-control mb-1" placeholder="E-mail" value="{{ $contato->email ?? old('email') }}">
                                <span class="text-error">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                            </div>


                        </div>

                        Interesse
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="tipo_id">
                                    <option value="">Tipo do Imóvel</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" @if(isset($contato->id)) {{ old('tipo_id', $contato->tipo_id) == $tipo->id ? 'selected' : '' }} @endif>
                                            {{ $tipo->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error"> {{ $errors->has('tipo_id') ? $errors->first('tipo_id') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="localizacao_id">
                                    <option value="">Localização do imóvel</option>
                                    @foreach ($localizacoes as $localizacao)
                                        <option value="{{ $localizacao->id }}" @if(isset($contato->id)) {{ old('localizacao_id', $contato->localizacao_id) == $localizacao->id ? 'selected' : '' }} @endif>
                                            {{ $localizacao->cidade }} - {{ $localizacao->bairro }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('localizacao_id') ? $errors->first('localizacao_id') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="fonte_id">
                                    <option value="">Fonte (de onde veio)</option>
                                    @foreach ($fontes as $fonte)
                                        <option value="{{ $fonte->id }}" @if(isset($contato->id)) {{ old('fonte_id', $contato->fonte_id) == $fonte->id ? 'selected' : '' }} @endif>
                                            {{ $fonte->descricao }}
                                        </option>

                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('fonte_id') ? $errors->first('fonte_id') : '' }}</span>
                            </div>
                        </div>

                        <div class="form-row d-flex justify-content-center mt-2">
                            <div class="form-group col-md-2">
                                @if (URL::previous() == 'http://localhost:8000/app/contato')
                                    <a href="{{ route('app.contato') }}" class="btn btn-danger">Cancelar</a>
                                @elseif (URL::previous() == 'http://localhost:8000/app/contato/consultar')
                                    <a href="{{ route('app.contato.consultar') }}" class="btn btn-danger">Cancelar</a>
                                @else
                                    <a href="{{ route('app.contato.exibir', $contato->id) }}" class="btn btn-danger">Cancelar</a>
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
                @if (URL::previous() == 'http://localhost:8000/app/contato')
                    <a href="{{ route('app.contato') }}" class="btn btn-amarelo mt-4 mb-3" role="button">Voltar</a>
                @elseif (URL::previous() == 'http://localhost:8000/app/contato/consultar')
                    <a href="{{ route('app.contato.consultar') }}" class="btn btn-amarelo mt-4 mb-3" role="button">Voltar</a>
                @else
                    <a href="{{ route('app.contato.exibir', $contato->id) }}" class="btn btn-amarelo mt-4 mb-3" role="button">Voltar</a>
                @endif
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
