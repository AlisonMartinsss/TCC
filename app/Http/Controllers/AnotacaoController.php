<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anotacao;
use App\Models\User;
use App\Models\Contato;

class AnotacaoController extends Controller{
    public function cadastrar($id){
        $contato = Contato::find($id)->id;
        $usuario = User::where('email', $_SESSION['email'])->first()->id;
        return view('app.anotacao.cadastrar', ['contato' => $contato, 'usuario' => $usuario]);
    }

    public function salvar(Request $request){
        $regras = [
            'descricao' => 'required|max:200',
        ];

        $feedback = [
            'required' => 'O campo descrição deve ser preenchido',
            'descricao.max' => 'O campo descricao deve ter no máximo 200 caracteres'
        ];

        $request->validate($regras, $feedback);

        $anotacao = new Anotacao();
        $anotacao->create($request->all());



        return redirect()->route('app.contato.exibir', $request->contato_id);

    }

    public function excluir($id){
        Anotacao::find($id)->delete();
        return redirect()->back();
    }
}
