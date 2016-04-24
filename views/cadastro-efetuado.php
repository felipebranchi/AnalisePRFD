<?php
//require_once("../classes/sessao.class.php");
include_once("../classes/app.php");

// Instancia a classe
$sessionClass = new Sessao();
// Verifica se não há um usuário logado
if ( $sessionClass->usuarioLogado() === true ) {
  // Não há um usuário logado, redireciona pra tela de login
  header("Location: index.php");
  exit;
}

include_once("partials/head.php");
include_once("partials/navbar.php"); ?>
            <div>
	        <h1>Cadastro efetuado com sucesso! Acesse a tela de login para entrar no sistema.</h1>
	    </div>
<?php include_once("partials/bottom.php"); ?>

?>