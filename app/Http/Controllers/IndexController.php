<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Imovel;
use App\Models\Tipo;
use App\Models\Localizacao;

class IndexController extends Controller{
    public function index(){
        $destaques = Imovel::where('destaque_id', 2)->get();
        $prontos = Imovel::where('estagio_id', 4)->get();
        $localizacoes = Localizacao::all();
        $tipos = Tipo::all();

        return view('site.index', ['destaques' => $destaques, 'prontos' => $prontos, 'localizacoes' => $localizacoes, 'tipos' => $tipos]);
    }
}
