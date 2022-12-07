<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use App\Models\User;

class HomeController extends Controller{
    public function index(){
        $contatos = Contato::all();
        $semContato = Contato::where('situacao_id', 1)->count();
        $contatoInicial = Contato::where('situacao_id', 2)->count();
        $propostaEnviada = Contato::where('situacao_id', 3)->count();
        $contratoAssinado = Contato::where('situacao_id', 4)->count();
        return view('app.home', ['contatos' => $contatos, 'semContato' => $semContato, 'contatoInicial' => $contatoInicial, 'propostaEnviada' => $propostaEnviada, 'contratoAssinado' => $contratoAssinado]);
    }
}
