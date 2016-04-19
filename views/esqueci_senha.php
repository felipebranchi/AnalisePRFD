<?php 

//require_once("../classes/sessao.class.php");
include_once("../classes/app.php");

  // Instancia a classe
  $sessionClass = new Sessao();
  // Verifica se não há um usuário logado
  if ( $sessionClass->usuarioLogado() === true ) {
    // Não há um usuário logado, redireciona pra tela de login
    header("Location: logged.php");
    exit;
  }
?>
<?php include_once("partials/head.php"); ?>
<?php include_once("partials/navbar.php"); ?>

      <div class="container">
        <div id="titleposition" class="page-header">
          <h1>Login</h1>
        </div>
        
        <div class="container">

        <form class="form-signin" method="POST" action="valida_login.php">
          <h3 class="form-signin-heading">Digite seu usuário.</h3>
          <label for="usuario" class="sr-only">Usuário</label>
          <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuário" required autofocus> <br>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
        </form>

      </div> <!-- /container -->

      </div>
<?php include_once("partials/bottom.php"); ?>
