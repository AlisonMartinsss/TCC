<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\User;
use App\Models\Contato;

class TarefaController extends Controller{
    public function index(){
        $tarefas = Tarefa::orderBy('data', 'desc')->orderBy('hora', 'desc')->get();
        $dataAtual = strtotime(now()->format('Y-m-d'));
        $horaAtual = strtotime(now()->format('H:i'));
        $usuario = User::where('email', $_SESSION['email'])->first()->id;
        $pendentes = Tarefa::where('user_id', $usuario)->where('status_id', 1)->count();
        $concluido = Tarefa::where('user_id', $usuario)->where('status_id', 2)->count();
        return view('app.tarefa.index', ['tarefas' => $tarefas, 'dataAtual' => $dataAtual, 'horaAtual' => $horaAtual, 'pendentes' => $pendentes, 'concluido' => $concluido]);
    }

    public function cadastrar($id){
        $contato = Contato::find($id)->id;
        $usuario = User::where('email', $_SESSION['email'])->first()->id;

        return view('app.tarefa.cadastrar', ['contato' => $contato, 'usuario' => $usuario]);
    }

    public function salvar(Request $request){
        //adicionar
        if($request->input('_token') != '' && $request->input('id') == ''){
            $regras = [
                'assunto' => 'required|min:3|max:20',
                'descricao' => 'required|min:3|max:40',
                'data' => 'required',
                'hora' => 'required',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'assunto.min' => 'O campo assunto deve ter no mínimo 3 caracteres',
                'assunto.max' => 'O campo assunto deve ter no máximo 20 caracteres',
                'descricao.required' => 'O campo descrição deve ser preenchido',
                'descricao.min' => 'O campo descricao deve ter no mínimo 3 caracteres',
                'descricao.max' => 'O campo descricao deve ter no máximo 40 caracteres'
            ];

            $request->validate($regras, $feedback);

            $tarefa = new Tarefa();
            $tarefa->create($request->all());

            return redirect()->route('app.contato.exibir', $request->contato_id);

        }

        //editar
        if($request->input('_token') != '' && $request->input('id') != ''){
            $regras = [
                'assunto' => 'required|min:3|max:20',
                'descricao' => 'required|min:3|max:40',
                'data' => 'required',
                'hora' => 'required',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'assunto.min' => 'O campo assunto deve ter no mínimo 3 caracteres',
                'assunto.max' => 'O campo assunto deve ter no máximo 20 caracteres',
                'descricao.required' => 'O campo descrição deve ser preenchido',
                'descricao.min' => 'O campo descricao deve ter no mínimo 3 caracteres',
                'descricao.max' => 'O campo descricao deve ter no máximo 40 caracteres'
            ];

            $request->validate($regras, $feedback);

            $tarefa = Tarefa::find($request->input('id'));
            $update = $tarefa->update($request->all());

            return redirect()->route('app.contato.exibir', $request->contato_id);
        }
    }

    public function concluir($id){
        $tarefa = Tarefa::find($id);
        $tarefa->update(['status_id' => 2]);
        return redirect()->back();
    }

    public function editar($id){
        $tarefa = Tarefa::find($id);
        $usuario = User::where('email', $_SESSION['email'])->first()->id;
        $contato = Contato::where('id', $tarefa->contato_id)->first()->id;
        return view('app.tarefa.cadastrar', ['tarefa' => $tarefa, 'contato' => $contato, 'usuario' => $usuario]);
    }

    public function excluir($id){
        Tarefa::find($id)->delete();
        return redirect()->back();
    }
}

