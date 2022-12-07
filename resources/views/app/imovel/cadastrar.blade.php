@extends('app.layouts.basico')

@section('titulo', 'Imóveis')

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
                            <li class="nav-item active">
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
                        @if (isset($imovel->id))
                            <h1 class="text-verde">Edição de Imóveis</h1>
                        @else
                            <h1 class="text-verde">Cadastro de Imóveis</h1>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 bg-cinzaaa">
                    <form action="{{ route('app.imovel.cadastrar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $imovel->id ?? '' }}">
                        <div class="form-row mt-3">

                            <div class="form-group col-md-8">
                                <input type="text" name="nome" class="form-control" placeholder="Nome do Imóvel" value="{{ $imovel->nome ?? old('nome') }}">
                                <span class="text-error">{{ $errors->has('nome') ? $errors->first('nome') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <input type="number" name="valor" class="form-control" placeholder="Valor" value="{{ $imovel->valor ?? old('valor') }}">
                                <span class="text-error">{{ $errors->has('valor') ? $errors->first('valor') : '' }}</span>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <input type="number" name="metragem_util" class="form-control" placeholder="Metragem Útil" value="{{ $imovel->metragem_util ?? old('metragem_util') }}">
                                <span class="text-error">{{ $errors->has('metragem_util') ? $errors->first('metragem_util') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <input type="number" name="metragem_total" class="form-control" placeholder="Metragem Total" value="{{ $imovel->metragem_total ?? old('metragem_total') }}">
                                <span class="text-error">{{ $errors->has('metragem_total') ? $errors->first('metragem_total') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <input type="number" name="entrada_minima_porcentagem" class="form-control" placeholder="Entrada (%)" value="{{ $imovel->entrada_minima_porcentagem ?? old('entrada_minima_porcentagem') }}">
                                <span class="text-error">{{ $errors->has('entrada_minima_porcentagem') ? $errors->first('entrada_minima_porcentagem') : '' }}</span>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="localizacao_id">
                                    <option value="">Localização</option>
                                    @foreach ($localizacoes as $localizacao)
                                        <option value="{{ $localizacao->id }}" @if(isset($imovel->id)) {{ old('localizacao_id', $imovel->localizacao_id) == $localizacao->id ? 'selected' : '' }} @endif>
                                            {{ $localizacao->cidade }} - {{ $localizacao->bairro }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('localizacao_id') ? $errors->first('localizacao_id') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="estado_id">
                                    <option value="">Estado do Imóvel</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}" @if(isset($imovel->id)) {{ old('estado_id', $imovel->estado_id) == $estado->id ? 'selected' : '' }} @endif>
                                            {{ $estado->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('estado_id') ? $errors->first('estado_id') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="destaque_id">
                                    <option value="">Destaque</option>
                                    @foreach ($destaques as $destaque)
                                        <option value="{{ $destaque->id }}" @if(isset($imovel->id)) {{ old('destaque_id', $imovel->destaque_id) == $destaque->id ? 'selected' : '' }} @endif>
                                            {{ $destaque->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('destaque_id') ? $errors->first('destaque_id') : '' }}</span>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="tipo_id">
                                    <option value="">Tipo do Imóvel</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" @if(isset($imovel->id)) {{ old('tipo_id', $imovel->tipo_id) == $tipo->id ? 'selected' : '' }} @endif>
                                            {{ $tipo->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('tipo_id') ? $errors->first('tipo_id') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="finalidade_id">
                                    <option value="">Finalidade do Imóvel</option>
                                    @foreach ($finalidades as $finalidade)
                                        <option value="{{ $finalidade->id }}" @if(isset($imovel->id)) {{ old('finalidade_id', $imovel->finalidade_id) == $finalidade->id ? 'selected' : '' }} @endif>
                                            {{ $finalidade->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('finalidade_id') ? $errors->first('finalidade_id') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="estagio_id">
                                    <option value="">Estágio da Obra</option>
                                    @foreach ($estagios as $estagio)
                                        <option value="{{ $estagio->id }}" @if(isset($imovel->id)) {{ old('estagio_id', $imovel->estagio_id) == $estagio->id ? 'selected' : '' }} @endif>
                                            {{ $estagio->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('estagio_id') ? $errors->first('estagio_id') : '' }}</span>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="banheiro_id">
                                    <option value="">Banheiros</option>
                                    @foreach ($banheiros as $banheiro)
                                        <option value="{{ $banheiro->id }}" @if(isset($imovel->id)) {{ old('banheiro_id', $imovel->banheiro_id) == $banheiro->id ? 'selected' : '' }} @endif>
                                            {{ $banheiro->quantidade }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('banheiro_id') ? $errors->first('banheiro_id') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="dormitorio_id">
                                    <option value="">Dormitórios</option>
                                    @foreach ($dormitorios as $dormitorio)
                                        <option value="{{ $dormitorio->id }}" @if(isset($imovel->id)) {{ old('dormitorio_id', $imovel->dormitorio_id) == $dormitorio->id ? 'selected' : '' }} @endif>
                                            {{ $dormitorio->quantidade }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('dormitorio_id') ? $errors->first('dormitorio_id') : '' }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <select class="custom-select" name="vaga_id">
                                    <option value="">Vagas de Garagem</option>
                                    @foreach ($vagas as $vaga)
                                        <option value="{{ $vaga->id }}" @if(isset($imovel->id)) {{ old('vaga_id', $imovel->vaga_id) == $vaga->id ? 'selected' : '' }} @endif>
                                            {{ $vaga->quantidade }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-error">{{ $errors->has('vaga_id') ? $errors->first('vaga_id') : '' }}</span>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="url" name="url_mapa" class="form-control" placeholder="URL do Mapa" value="{{ $imovel->url_mapa ?? old('url_mapa') }}">
                                <span class="text-error">{{ $errors->has('url_mapa') ? $errors->first('url_mapa') : '' }}</span>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="file" class="custom-file-input" id="inputArquivo" name="foto_principal" accept=".jpg, .jpeg, .png">
                                <label id="labelArquivo" class="custom-file-label" for="customFile">Foto Principal</label>
                                <span class="text-error">{{ $errors->has('foto_principal') ? $errors->first('foto_principal') : '' }}</span>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="textarea" name="descricao" class="form-control" placeholder="Descrição do Imóvel" value="{{ $imovel->descricao ?? old('descricao') }}">
                                <span class="text-error">{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}</span>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="file" class="custom-file-input" id="inputArquivos" name="fotos[]" accept=".jpg, .jpeg, .png" multiple>
                                <label id="labelArquivos" class="custom-file-label" for="customFiles">Fotos</label>
                                <span class="text-error">{{ $errors->has('fotos') ? $errors->first('fotos') : '' }}</span>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="text" name="detalhes" class="form-control mb-1" placeholder="Detalhes (utilize a vírgula para separar)" @if (isset($imovel->id)) value="{{ implode(",", $imovel->detalhes)}}"  @endif>
                                <span class="text-error">{{ $errors->has('detalhes') ? $errors->first('detalhes') : '' }}</span>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="text" name="caracteristicas" class="form-control mb-1" placeholder="Características (utilize a vírgula para separar)" @if (isset($imovel->id)) value="{{ implode(",", $imovel->caracteristicas)}}"  @endif>
                                <span class="text-error">{{ $errors->has('caracteristicas') ? $errors->first('caracteristicas') : '' }}</span>
                            </div>


                        </div>



                        <div class="form-row d-flex justify-content-center">
                            <div class="form-group col-md-2">
                                @if (URL::previous() == 'http://localhost:8000/app/imovel')
                                    <a href="{{ route('app.imovel') }}" class="btn btn-danger">Cancelar</a>
                                @else
                                    <a href="{{ route('app.imovel.consultar') }}" class="btn btn-danger">Cancelar</a>
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
                @if (URL::previous() == 'http://localhost:8000/app/imovel')
                    <a href="{{ route('app.imovel') }}" class="btn btn-amarelo mt-4 mb-3" role="button">Voltar</a>
                @else
                    <a href="{{ route('app.imovel.consultar') }}" class="btn btn-amarelo mt-4 mb-3" role="button">Voltar</a>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $("#inputArquivo").on("change", function() {
            var nome = $(this).val().split("\\").pop();
            $(this).siblings("#labelArquivo").addClass("selected").html(nome);
        });

        const inputArquivos = document.getElementById('inputArquivos');
        inputArquivos.addEventListener('change', (event) => {
            const listaArquivos = event.target.files;
            document.getElementById('labelArquivos').innerHTML = listaArquivos.length + ' arquivo(s) selecionado(s)';
        });
    </script>
@endsection
