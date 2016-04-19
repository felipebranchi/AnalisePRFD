<?php 

// Inclui o arquivo com a classe de login
//require_once("../classes/sessao.class.php");
include_once("../classes/app.php");

// Instancia a classe
$sessionClass = new Sessao();
?>
<?php include_once("partials/head.php"); ?>
<?php include_once("partials/navbar.php"); ?>

	    <div class="container">
	      <div class="page-header">
	        <h1>Bem vindo!</h1>
	      </div>
	      <p class="lead">Seja bem vindo ao Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum quis nisi tellus. Sed ac libero porta, eleifend turpis nec, convallis lacus. Maecenas a lacus accumsan, pellentesque tortor ac, imperdiet mi. Curabitur odio nisl, tincidunt at porta et, sagittis quis enim. In placerat, ex sit amet sagittis viverra, dolor odio dictum odio, et rhoncus turpis ex at urna. Nullam id ante ligula. Fusce laoreet nunc ut libero convallis, sed vehicula odio vehicula. Nullam a molestie leo.</p>
	    </div>
<?php include_once("partials/bottom.php"); ?>
