<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller{
    public function index(Request $request){
        $erro = '';
        if($request->get('erro') == 1){
            $erro = 'Usuário e ou senha incorretos!';
        }

        if($request->get('erro') == 2){
            $erro = 'Necessário realizar login!!!';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function login(Request $request){
        $regras = [
            'email' => 'email',
            'senha' => 'required'
        ];

        $feedback = [
            'email.email' => 'O campo e-mail é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('email');
        $senha = $request->get('senha');

        $user = new User();
        $usuario = $user->where('email', $email)
                       ->where('senha', $senha)
                       ->first();

        if(isset($usuario->nome)){
            session_start();

            $_SESSION['id'] = $usuario->id;
            $_SESSION['nome'] = $usuario->nome;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['funcao_id'] = $usuario->funcao_id;



            return redirect()->route('app.home');
        } else{
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair(){
        session_destroy();
        return redirect()->route('site.login');
    }
}
