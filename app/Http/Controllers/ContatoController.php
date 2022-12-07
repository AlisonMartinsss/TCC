<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use App\Models\Tipo;
use App\Models\Localizacao;
use App\Models\Situacao;
use App\Models\Fonte;
use App\Models\Tarefa;
use App\Models\Anotacao;
use App\Models\User;

class ContatoController extends Controller{
    public function index(){
        $tipos = Tipo::all();
        $localizacoes = Localizacao::all();
        $situacoes = Situacao::all();
        //$usuario = User::where('funcao_id', 1)->where('email', 'alison@teste.com')->first()->email;
        return view('app.contato.index', ['tipos' => $tipos, 'localizacoes' => $localizacoes, 'situacoes' => $situacoes]);
    }

    public function consultar(Request $request){
        $contatos = Contato::where('nome', 'like', '%'.$request->input('nome').'%')
                            ->where('telefone', 'like', '%'.$request->input('telefone').'%')
                            ->where('email', 'like', '%'.$request->input('email').'%')
                            ->where('tipo_id', 'like', '%'.$request->input('tipo_id').'%')
                            ->where('localizacao_id', 'like', '%'.$request->input('localizacao_id').'%')
                            ->where('situacao_id', 'like', '%'.$request->input('situacao_id').'%')
                            ->paginate(15);
        $qtdContatos = Contato::get()->count();
        return view('app.contato.consultar', ['contatos' => $contatos, 'request' => $request->all(), 'qtdContatos' => $qtdContatos]);
    }

    public function cadastrar(Request $request){
        $situacoes = Situacao::all();
        $tipos = Tipo::all();
        $localizacoes = Localizacao::all();
        $fontes = Fonte::all();
        $usuario = User::where('email', $_SESSION['email'])->first()->id;

        //adição
        if($request->input('_token') != '' && $request->input('id') == ''){
            $regras = [
                'nome' => 'required|min:3|max:40',
                'telefone' => 'required',
                'email' => 'required|email',
                'tipo_id' => 'exists:tipos,id',
                'localizacao_id' => 'exists:localizacoes,id',
                'situacao_id' => 'exists:situacoes,id',
                'fonte_id' => 'exists:fontes,id',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente',
                'tipo_id.exists' =>  'O tipo de imóvel informado não existe',
                'localizacao_id.exists' =>  'A cidade informada não existe',
                'situacao_id.exists' =>  'A situação informada não existe',
                'fonte_id.exists' =>  'A fonte informada não existe'
            ];

            $request->validate($regras, $feedback);

            $contato = new Contato();
            $contato->create($request->all());

            return redirect()->route('app.contato.consultar');

        }

        //edição
        if($request->input('_token') != '' && $request->input('id') != ''){
            $regras = [
                'nome' => 'required|min:3|max:40',
                'telefone' => 'required',
                'email' => 'required|email',
                'tipo_id' => 'exists:tipos,id',
                'localizacao_id' => 'exists:localizacoes,id',
                'situacao_id' => 'exists:situacoes,id',
                'fonte_id' => 'exists:fontes,id',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente',
                'tipo_id.exists' =>  'O tipo de imóvel informado não existe',
                'localizacao_id.exists' =>  'A cidade informada não existe',
                'situacao_id.exists' =>  'A situação informada não existe',
                'fonte_id.exists' =>  'A fonte informada não existe'
            ];

            $request->validate($regras, $feedback);

            $contato = Contato::find($request->input('id'));
            $update = $contato->update($request->all());

            return redirect()->route('app.contato.consultar', ['id' => $request->input('id')]);
        }

        return view('app.contato.cadastrar', ['usuario' => $usuario, 'situacoes' => $situacoes, 'tipos' => $tipos, 'localizacoes' => $localizacoes, 'fontes' => $fontes]);
    }

    public function exibir($id){
        $tarefas = Tarefa::orderBy('data', 'desc')->orderBy('hora', 'desc')->get();
        $dataAtual = strtotime(now()->format('Y-m-d'));
        $horaAtual = strtotime(now()->format('H:i'));
        $anotacoes = Anotacao::orderBy('id', 'desc')->get();
        $contato = Contato::find($id);
        $usuario = User::where('email', $_SESSION['email'])->first()->id;
        $qtdTarefas = Tarefa::where('contato_id', $id)->where('user_id', $usuario)->count();
        $qtdAnotacoes = Anotacao::where('contato_id', $id)->count();
        return view('app.contato.exibir', ['qtdTarefas' => $qtdTarefas, 'qtdAnotacoes' => $qtdAnotacoes, 'contato' => $contato, 'tarefas' => $tarefas, 'anotacoes' => $anotacoes, 'dataAtual' => $dataAtual, 'horaAtual' => $horaAtual]);
    }

    public function editar($id){
        $situacoes = Situacao::all();
        $tipos = Tipo::all();
        $localizacoes = Localizacao::all();
        $fontes = Fonte::all();
        $contato = Contato::find($id);
        return view('app.contato.cadastrar', ['contato' => $contato, 'situacoes' => $situacoes, 'tipos' => $tipos, 'localizacoes' => $localizacoes, 'fontes' => $fontes]);
    }

    public function excluir($id){
        Anotacao::where('contato_id', $id)->delete();
        Tarefa::where('contato_id', $id)->delete();
        Contato::find($id)->delete();
        return redirect()->route('app.contato.consultar');
    }
}
