<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensagem;
use App\Models\Assunto;

class MensagemController extends Controller{
    public function index(){
        $assuntos = Assunto::all();
        return view('site.mensagem', ['assuntos' => $assuntos]);
    }

    public function salvar(Request $request) {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'assunto_id' => 'exists:assuntos,id',
            'descricao' => 'required|max:2000'
        ];

        $feedback = [
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O nome deve ter no máximo 40 caracteres',
            'email.email' => 'O e-mail informado não é válido',
            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',
            'required' => 'O campo :attribute deve ser preenchido',
            'descricao.required' => 'O campo descrição deve ser preenchido',
            'assunto_id.exists' => 'A opção de assunto selecionada não existe',
        ];

        $request->validate($regras, $feedback);
        $mensagem = new Mensagem();
        $mensagem->create($request->all());
        return redirect()->back()->with('status', 'Mensagem Enviada!');
    }

    public function principal(){
        $mensagens = Mensagem::all();
        $pendentes = Mensagem::where('status_id', 1)->count();
        $concluido = Mensagem::where('status_id', 2)->count();
        return view('app.mensagem.principal', ['mensagens' => $mensagens, 'pendentes' => $pendentes, 'concluido' => $concluido]);
    }

    public function exibir($id){
        $mensagem = Mensagem::find($id);
        return view('app.mensagem.exibir', ['mensagem' => $mensagem]);
    }

    public function concluir($id){
        $mensagem = Mensagem::find($id);
        $mensagem->update(['status_id' => 2]);
        return redirect()->back();
    }

    public function excluir($id){
        Mensagem::find($id)->delete();
        return redirect()->route('app.mensagem');
    }
}
