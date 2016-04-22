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
include_once("partials/navbar.php");


$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
// Se o campo "lembrar" não existir, o script funcionará normalmente
$lembrar = (isset($_POST['lembrar']) AND !empty($_POST['lembrar']));
// Tenta logar o usuário com os dados
if ( $sessionClass->logaUsuario( $usuario, $senha, $lembrar ) ) {
  // Usuário logado com sucesso, redireciona ele para a página restrita
  header("Location: logged.php");
  exit;
} else {
  // Não foi possível logar o usuário, exibe a mensagem de erro
  echo "<strong>Erro: </strong>" . $sessionClass->erro;
}

include_once("partials/bottom.php");

/* ISSO AQUI VAI NAS PÁGINAS QUE PRECISAM DE ESTAR LOGADO

// Inclui o arquivo com a classe de login
require_once("includes/classes/usuarios.class.php");
// Instancia a classe
$userClass = new Usuario();
// Verifica se não há um usuário logado
if ( $userClass->usuarioLogado() === false ) {
  // Não há um usuário logado, redireciona pra tela de login
  header("Location: login.php");
  exit;
} */

?>