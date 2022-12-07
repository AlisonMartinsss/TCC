<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\Finalidade;
use App\Models\Localizacao;
use App\Models\Tipo;
use App\Models\Estado;
use App\Models\Estagio;
use App\Models\Dormitorio;
use App\Models\Banheiro;
use App\Models\Vaga;

class BuscaController extends Controller{
    public function index(){
        $imoveis = Imovel::all();
        $finalidades = Finalidade::all();
        $localizacoes = Localizacao::all();
        $tipos = Tipo::all();
        $estados = Estado::all();
        $estagios = Estagio::all();
        $dormitorios = Dormitorio::all();
        $banheiros = Banheiro::all();
        $vagas = Vaga::all();

        $totalVendas = Imovel::query()
            ->where('finalidade_id' , 2)
            ->count();

        $totalAluguel = Imovel::query()
            ->where('finalidade_id' , 1)
            ->count();

        return view(
            'site.busca',
            [
                'imoveis' => $imoveis,
                'finalidades' => $finalidades,
                'localizacoes' => $localizacoes,
                'tipos' => $tipos,
                'estados' => $estados,
                'estagios' => $estagios,
                'dormitorios' => $dormitorios,
                'banheiros' => $banheiros,
                'vagas' => $vagas,
                'totalVendas' => $totalVendas,
                'totalAluguel' => $totalAluguel
            ]
        );
    }

    public function buscar(Request $request){
        $finalidades = Finalidade::all();
        $localizacoes = Localizacao::all();
        $tipos = Tipo::all();
        $estados = Estado::all();
        $estagios = Estagio::all();
        $dormitorios = Dormitorio::all();
        $banheiros = Banheiro::all();
        $vagas = Vaga::all();
        $imoveis = Imovel::where('nome'
        , 'like', '%'.$request->input('nome').'%')
                         ->where('finalidade_id', 'like', '%'.$request->input('finalidade_id').'%')
                         ->where('localizacao_id', 'like', '%'.$request->input('localizacao_id').'%')
                         ->where('tipo_id', 'like', '%'.$request->input('tipo_id').'%')
                         ->where('estado_id', 'like', '%'.$request->input('estado_id').'%')
                         ->where('estagio_id', 'like', '%'.$request->input('estagio_id').'%')
                         ->where('dormitorio_id', 'like', '%'.$request->input('dormitorio_id').'%')
                         ->where('banheiro_id', 'like', '%'.$request->input('banheiro_id').'%')
                         ->where('vaga_id', 'like', '%'.$request->input('vaga_id').'%')
                         ->paginate(15);

        return view('site.busca', ['imoveis' => $imoveis, 'request' => $request->all(), 'finalidades' => $finalidades, 'localizacoes' => $localizacoes, 'tipos' => $tipos, 'estados' => $estados,  'estagios' => $estagios, 'dormitorios' => $dormitorios, 'banheiros' => $banheiros, 'vagas' => $vagas]);
    }
}
