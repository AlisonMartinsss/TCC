@extends('app.layouts.basico')

@section('titulo', 'Perfil')

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
            <div class="d-flex justify-content-center mt-5">
                @if (!isset($usuario->foto_perfil))
                    <img src="{{asset('img/perfilPreto.png')}}" width="100" height="100" class="foto_perfil">
                @else
                    <img src="{{asset('storage/image/'.$usuario->foto_perfil)}}" width="100" height="100" class="foto_perfil">
                @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="d-flex justify-content-center mt-3">
              <h5>Bem-vindo, {{$usuario->nome}}</h5> <a href="{{route('app.perfil.editar', $usuario->id)}}" class="ml-3"><i class="fas fa-edit text-body"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 borda-redonda my-3">
            <div class="d-flex justify-content-center"style="border-bottom: 1px solid #D9D9D9">
              <span class="texto-grande my-2">Informações Pessoais</span>
            </div>
            <div class="py-2">
              Nome<span class="float-right">{{$usuario->nome}}</span>
            </div>
            <div class="py-2">
              Data de Nascimento<span class="float-right">{{date('d/m/Y', strtotime($usuario->nascimento))}}</span>
            </div>
            <div class="py-2">
              Função<span class="float-right">{{$usuario->funcao->descricao}}</span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 borda-redonda mb-3">
            <div class="d-flex justify-content-center"style="border-bottom: 1px solid #D9D9D9">
              <span class="texto-grande my-2">Informações de Contato</span>
            </div>
            <div class="py-2">
              Telefone<span class="float-right telefone">{{$usuario->telefone}}</span>
            </div>
            <div class="py-2">
              E-mail<span class="float-right">{{$usuario->email}}</span>
            </div>
            <div class="py-2">
              Senha<span id="senhaPerfil" class="float-right">{{str_repeat('*', strlen($usuario->senha))}}</span>
            </div>
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
        $(document).ready(function(){
            $('.telefone').mask('(99) 9 9999-9999');
        });
    </script>
@endsection
