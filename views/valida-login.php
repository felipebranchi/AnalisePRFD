<?php 

include_once("../classes/app.php");
//include_once("../classes/sessao.class.php");
	
	/**
     * Conexao com o banco
     * 
     * @var mixed
     * @since v1.0
     */
    //$conexao = mysql_connect('localhost', 'root', '');
     ?>

<!DOCTYPE html>
<html lang="en">
	<head>

	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" href="../images/icon.ico">

	    <title>Login - Identi-find</title>

	    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    	<link href="../bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    	<link href="css/style.css" rel="stylesheet">

	</head>
	<body>
	</body> 
</html>

<?php
// Instancia a classe
$sessionClass = new Sessao();
// Pega os dados vindos do formulário
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