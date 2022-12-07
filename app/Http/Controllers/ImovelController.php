<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\Contato;
use App\Models\Destaque;
use App\Models\Tipo;
use App\Models\Localizacao;
use App\Models\Finalidade;
use App\Models\Estagio;
use App\Models\Estado;
use App\Models\Banheiro;
use App\Models\Dormitorio;
use App\Models\Vaga;
use App\Models\User;

class ImovelController extends Controller{
    public function imovel($id){
        $imovel = Imovel::find($id);
        $usuario = User::first()->id;
        return view('site.imovel', ['imovel' => $imovel, 'usuario' => $usuario]);
    }

    public function interesse(Request $request){
        if($request->input('_token') != ''){
            $regras = [
                'nome' => 'required|min:3|max:40',
                'telefone' => 'required',
                'email' => 'required|email',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            $contatoExiste = Contato::where('telefone', $request->input('telefone'))->count();

            if($contatoExiste == 0){
                $contato = new Contato();
                $contato->create($request->all());
                return redirect()->back()->with('status', 'Interesse Cadastrado!');
            } else{
                $contato = Contato::where('telefone', $request->input('telefone'))
                                  ->update(['tipo_id' => $request->input('tipo_id'), 'localizacao_id' => $request->input('localizacao_id'), 'situacao_id' => 1]);
                return redirect()->back()->with('status', 'Interesse Atualizado!');
            }
        }
    }

    public function principal(){
        $tipos = Tipo::all();
        $localizacoes = Localizacao::all();
        $estagios = Estagio::all();
        return view('app.imovel.index', ['tipos' => $tipos, 'localizacoes' => $localizacoes, 'estagios' => $estagios]);
    }

    public function consultar(Request $request){
        $imoveis = Imovel::where('id', 'like', '%'.$request->input('id').'%')
                            ->where('nome', 'like', '%'.$request->input('nome').'%')
                            ->where('valor', 'like', '%'.$request->input('valor').'%')
                            ->where('tipo_id', 'like', '%'.$request->input('tipo_id').'%')
                            ->where('localizacao_id', 'like', '%'.$request->input('localizacao_id').'%')
                            ->where('estagio_id', 'like', '%'.$request->input('estagio_id').'%')
                            ->paginate(15);
        $qtdImoveis = Imovel::get()->count();
        return view('app.imovel.consultar', ['imoveis' => $imoveis, 'request' => $request->all(), 'qtdImoveis' => $qtdImoveis]);
    }

    public function cadastrar(Request $request){
        $destaques = Destaque::all();
        $tipos = Tipo::all();
        $localizacoes = Localizacao::all();
        $finalidades = Finalidade::all();
        $estagios = Estagio::all();
        $estados = Estado::all();
        $banheiros = Banheiro::all();
        $dormitorios = Dormitorio::all();
        $vagas = Vaga::all();

        $detalhes = $request->detalhes;
        $detalhesArray = explode(",", $detalhes);

        $caracteristicas = $request->caracteristicas;
        $caracteristicasArray = explode(",", $caracteristicas);

        if ($foto = $request->file('foto_principal')) {
                $nome = now()->timestamp. '_' .$foto->getClientOriginalName();
                $foto->storeAs('public/image', $nome);
                $foto = $nome;
        }

        if($request->hasfile('fotos')){

            foreach($request->file('fotos') as $image){
                $name = now()->timestamp. '_' .$image->getClientOriginalName();
                $image->storeAs('public/image', $name);
                $fotos[] = $name;
            }
        }

        //adição
        if($request->input('_token') != '' && $request->input('id') == ''){
            $regras = [
                'nome' => 'required|min:4|max:50',
                'valor' => 'required',
                'metragem_util' => 'required',
                'metragem_total' => 'required',
                'entrada_minima_porcentagem' => 'required',
                'localizacao_id' => 'exists:localizacoes,id',
                'estado_id' => 'exists:estados,id',
                'destaque_id' => 'exists:destaques,id',
                'tipo_id' => 'exists:tipos,id',
                'finalidade_id' => 'exists:finalidades,id',
                'estagio_id' => 'exists:estagios,id',
                'banheiro_id' => 'exists:banheiros,id',
                'dormitorio_id' => 'exists:dormitorios,id',
                'vaga_id' => 'exists:vagas,id',
                'url_mapa' => 'required',
                'foto_principal' => 'required|mimes:jpg,png,jpeg',
                'descricao' => 'required|max:2000',
                'detalhes' => 'required',
                'caracteristicas' => 'required',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'metragem_util.required' => 'O campo metragem útil deve ser preenchido',
                'entrada_minima_porcentagem.required' => 'O campo entrada deve ser preenchido',
                'url_mapa.required' => 'O campo url do mapa deve ser preenchido',
                'descricao.required' => 'O campo descrição deve ser preenchido',
                'caracteristicas.required' => 'O campo características deve ser preenchido',
                'foto_principal.mimes' => 'A extensão deve ser JPG, JPEG ou PNG',
                'nome.min' => 'O campo nome deve ter no mínimo 4 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 50 caracteres',
                'descricao.max' => 'O campo descrição deve ter no máximo 2000 caracteres',
                'localizacao_id.exists' =>  'A localização informada não existe',
                'estado_id.exists' =>  'O estado do imóvel informado não existe',
                'destaque_id.exists' =>  'A opção informada não existe',
                'tipo_id.exists' =>  'O tipo do imóvel informado não existe',
                'finalidade_id.exists' =>  'A finalidade do imóvel informado não existe',
                'estagio_id.exists' =>  'O estágio do imóvel informado não existe',
                'banheiro_id.exists' =>  'A quantidade informada não existe',
                'dormitorio_id.exists' =>  'A quantidade informada não existe',
                'vaga_id.exists' =>  'A quantidade informada não existe',
            ];

            $request->validate($regras, $feedback);

            $imovel = Imovel::create([
                'nome' => $request->nome,
                'valor' => $request->valor,
                'metragem_util' => $request->metragem_util,
                'metragem_total' => $request->metragem_total,
                'entrada_minima_porcentagem' => $request->entrada_minima_porcentagem,
                'localizacao_id' => $request->localizacao_id,
                'estado_id' => $request->estado_id,
                'destaque_id' => $request->destaque_id,
                'tipo_id' => $request->tipo_id,
                'finalidade_id' => $request->finalidade_id,
                'estagio_id' => $request->estagio_id,
                'banheiro_id' => $request->banheiro_id,
                'dormitorio_id' => $request->dormitorio_id,
                'vaga_id' => $request->vaga_id,
                'url_mapa' => $request->url_mapa,
                'foto_principal' => $foto,
                'fotos' => $fotos,
                'descricao' => $request->descricao,
                'detalhes' => $detalhesArray,
                'caracteristicas' => $caracteristicasArray,
            ]);

            return redirect()->route('app.imovel.consultar');
        }

        //edição
        if($request->input('_token') != '' && $request->input('id') != ''){
            $regras = [
                'nome' => 'required|min:4|max:50',
                'valor' => 'required',
                'metragem_util' => 'required',
                'metragem_total' => 'required',
                'entrada_minima_porcentagem' => 'required',
                'localizacao_id' => 'exists:localizacoes,id',
                'estado_id' => 'exists:estados,id',
                'destaque_id' => 'exists:destaques,id',
                'tipo_id' => 'exists:tipos,id',
                'finalidade_id' => 'exists:finalidades,id',
                'estagio_id' => 'exists:estagios,id',
                'banheiro_id' => 'exists:banheiros,id',
                'dormitorio_id' => 'exists:dormitorios,id',
                'vaga_id' => 'exists:vagas,id',
                'url_mapa' => 'required',
                'foto_principal' => 'required|mimes:jpg,png,jpeg',
                'descricao' => 'required|max:2000',
                'detalhes' => 'required',
                'caracteristicas' => 'required',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'metragem_util.required' => 'O campo metragem útil deve ser preenchido',
                'entrada_minima_porcentagem.required' => 'O campo entrada deve ser preenchido',
                'url_mapa.required' => 'O campo url do mapa deve ser preenchido',
                'descricao.required' => 'O campo descrição deve ser preenchido',
                'caracteristicas.required' => 'O campo características deve ser preenchido',
                'foto_principal.mimes' => 'A extensão deve ser JPG, JPEG ou PNG',
                'nome.min' => 'O campo nome deve ter no mínimo 4 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 50 caracteres',
                'descricao.max' => 'O campo descrição deve ter no máximo 2000 caracteres',
                'localizacao_id.exists' =>  'A localização informada não existe',
                'estado_id.exists' =>  'O estado do imóvel informado não existe',
                'destaque_id.exists' =>  'A opção informada não existe',
                'tipo_id.exists' =>  'O tipo do imóvel informado não existe',
                'finalidade_id.exists' =>  'A finalidade do imóvel informado não existe',
                'estagio_id.exists' =>  'O estágio do imóvel informado não existe',
                'banheiro_id.exists' =>  'A quantidade informada não existe',
                'dormitorio_id.exists' =>  'A quantidade informada não existe',
                'vaga_id.exists' =>  'A quantidade informada não existe',
            ];

            $request->validate($regras, $feedback);

            $imovel = Imovel::find($request->input('id'));

            $imovel->update([
                'nome' => $request->nome,
                'valor' => $request->valor,
                'metragem_util' => $request->metragem_util,
                'metragem_total' => $request->metragem_total,
                'entrada_minima_porcentagem' => $request->entrada_minima_porcentagem,
                'localizacao_id' => $request->localizacao_id,
                'estado_id' => $request->estado_id,
                'destaque_id' => $request->destaque_id,
                'tipo_id' => $request->tipo_id,
                'finalidade_id' => $request->finalidade_id,
                'estagio_id' => $request->estagio_id,
                'banheiro_id' => $request->banheiro_id,
                'dormitorio_id' => $request->dormitorio_id,
                'vaga_id' => $request->vaga_id,
                'url_mapa' => $request->url_mapa,
                'foto_principal' => $foto,
                'fotos' => $fotos,
                'descricao' => $request->descricao,
                'detalhes' => $detalhesArray,
                'caracteristicas' => $caracteristicasArray,
            ]);

            return redirect()->route('app.imovel.consultar');
        }

        return view('app.imovel.cadastrar', ['destaques' => $destaques, 'tipos' => $tipos, 'localizacoes' => $localizacoes, 'finalidades' => $finalidades, 'estagios' => $estagios, 'estados' => $estados, 'banheiros' => $banheiros, 'dormitorios' => $dormitorios, 'vagas' => $vagas]);
    }

    public function editar($id){
        $destaques = Destaque::all();
        $tipos = Tipo::all();
        $localizacoes = Localizacao::all();
        $finalidades = Finalidade::all();
        $estagios = Estagio::all();
        $estados = Estado::all();
        $banheiros = Banheiro::all();
        $dormitorios = Dormitorio::all();
        $vagas = Vaga::all();
        $imovel = Imovel::find($id);
        return view('app.imovel.cadastrar', ['imovel' => $imovel, 'destaques' => $destaques, 'tipos' => $tipos, 'localizacoes' => $localizacoes, 'finalidades' => $finalidades, 'estagios' => $estagios, 'estados' => $estados, 'banheiros' => $banheiros, 'dormitorios' => $dormitorios, 'vagas' => $vagas]);
    }

    public function excluir($id){
        Imovel::find($id)->delete();
        return redirect()->route('app.imovel.consultar');
    }
}
