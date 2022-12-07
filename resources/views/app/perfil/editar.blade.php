@extends('app.layouts.basico')

@section('titulo', 'Perfil')

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
                        <li class="nav-item">
                            <a href="{{ route('app.tarefa') }}" class="nav-link">Tarefas</a>
                        </li>
                        <li class="nav-item active">
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
                        <h1 class="text-verde">Edição de Perfil</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 bg-cinzaaa">
                    <form action="{{ route('app.perfil.salvar') }}" method="post" class="mt-3" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $usuario->id ?? '' }}">

                        <div class="form-row">

                            <div class="form-group col-md-8">
                                <input type="text" value="{{ $usuario->nome ?? old('nome') }}" name="nome" class="form-control" placeholder="Nome">
                                <span class="text-error">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <input type="file" class="custom-file-input" id="input" name="foto_perfil" accept=".jpg, .jpeg, .png">
                                <label id="label" class="custom-file-label" for="customFile">Foto Perfil</label>
                            </div>


                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="date" value="{{ $usuario->nascimento ?? old('nascimento') }}" name="nascimento" class="form-control" placeholder="Data de Nascimento">
                                <span class="text-error">{{ $errors->has('nascimento') ? $errors->first('nascimento') : '' }}</span>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="tel" value="{{ $usuario->telefone ?? old('telefone') }}" name="telefone" class="form-control" placeholder="Telefone">
                                <span class="text-error">{{ $errors->has('telefone') ? $errors->first('telefone') : '' }}</span>
                            </div>


                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="email" value="{{ $usuario->email ?? old('email') }}" name="email" class="form-control" placeholder="E-mail">
                                <span class="text-error">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="password" value="{{ $usuario->senha ?? old('senha') }}" name="senha" class="form-control" placeholder="Senha">
                                <span class="text-error">{{ $errors->has('senha') ? $errors->first('senha') : '' }}</span>
                            </div>

                        </div>

                        <div class="form-row d-flex justify-content-center">
                            <div class="form-group col-md-2">
                                <a href="{{ route('app.perfil') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn btn-verde" type="submit">Salvar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('app.perfil') }}" class="btn btn-amarelo mt-4 mb-3" role="button">Voltar</a>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $("#input").on("change", function() {
            var nome = $(this).val().split("\\").pop();
            $(this).siblings("#label").addClass("selected").html(nome);
        });
    </script>
@endsection
