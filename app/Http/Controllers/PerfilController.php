<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Funcao;

class PerfilController extends Controller{
    public function index(){
        $usuario = User::where('email', $_SESSION['email'])->first();
        return view('app.perfil.index', ['usuario' => $usuario]);
    }

    public function editar($id){
        $usuario = User::find($id);
        return view('app.perfil.editar', ['usuario' => $usuario]);
    }

    public function salvar(Request $request){
        if ($foto_perfil = $request->file('foto_perfil')) {
            $nome = now()->timestamp. '_' .$foto_perfil->getClientOriginalName();
            $foto_perfil->storeAs('public/image', $nome);
            $foto_perfil = $nome;
        }

        $regras = [
            'nome' => 'required|min:3|max:30',
            'nascimento' => 'required',
            'telefone' => 'required',
            'email' => 'required|email',
            'senha' => 'required|min:8',

        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 30 caracteres',
            'email.email' => 'O campo e-mail não foi preenchido corretamente',
            'senha.min' => 'O campo senha deve ter no mínimo 8 caracteres',
        ];

        //dd($request);

        $request->validate($regras, $feedback);

        $usuario = User::find($request->input('id'));

        $usuario->update([
            'nome' => $request->nome,
            'foto_perfil' => $foto_perfil,
            'nascimento' => $request->nascimento,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'senha' => $request->senha
        ]);

        return redirect()->route('app.perfil');
    }
}
