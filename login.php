<!doctype html>
<html lang="en">
<head>
  <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <form class="form-signin">
    <img class="mb-4" src="imagens/logo.jpg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Faça o Login</h1>
    <label for="inputLogin" class="sr-only">Login</label>
    <input type="text" id="inputLogin" style="margin-bottom: 10px" class="form-control" placeholder="Login" required autofocus>
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Lembre-me
      </label>
    </div>
    <button class="btn btn-lg btn-info btn-block" type="submit">Logar</button>
  </form>
</body>
</html>
