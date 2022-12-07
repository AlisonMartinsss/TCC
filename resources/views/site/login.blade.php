<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <title>Libertá - Login</title>
  </head>
  <body class="bg-verde">
    <div id="login">
      <img src="{{asset('img/perfil.png')}}">
      <form action="{{route('site.login')}}" method="POST">
        @csrf
        <div class="form-group">
          <input type="email" class="form-control emailLogin input" placeholder="Digite seu e-mail" name="email" value="{{old('email')}}">
          <span class="text-error">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
        </div>
        <div class="form-group">
          <input type="password" class="form-control senhaLogin input" placeholder="Digite sua senha" name="senha" value="{{old('senha')}}">
          <span class="text-error">{{ $errors->has('senha') ? $errors->first('senha') : '' }}</span>
        </div>
        <button type="submit" class="btn btn-primary btnLogin">Entrar</button>
      </form>
      <span class="text-error mt-3">{{isset($erro) && $erro != '' ? $erro : ''}}</span>
    </div>
  </body>
</html>
