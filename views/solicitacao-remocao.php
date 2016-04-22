<?php
//require_once("../classes/sessao.class.php");
include_once("../classes/app.php");

// Instancia a classe
$sessionClass = new Sessao();
// Verifica se não há um usuário logado
if ( $sessionClass->usuarioLogado() === false ) {
  // Não há um usuário logado, redireciona pra tela de login
  header("Location: login.php");
  exit;
}

include_once("partials/head.php");
include_once("partials/navbar.php"); ?>

<?php include_once("partials/bottom.php"); ?>

?>