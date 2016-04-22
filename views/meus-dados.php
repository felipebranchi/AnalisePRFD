<?php 

// Inclui o arquivo com a classe de login
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
?>
<?php include_once("partials/head.php"); ?>
<?php include_once("partials/navbar.php"); ?>
	      <div>
	        <h1>Bem vindo, <?php echo ucfirst($_SESSION['usuario_nome']); ?>!</h1>
	      </div>
<?php include_once("partials/bottom.php"); ?>