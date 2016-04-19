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
		<div class="col-lg-8">
			<div id="titleposition" class="page-header">
				<h1>Cadastrar Senha</h1>
			</div>
			
			<div class="col-lg-12">
			<form method="POST" action="">
				<h3>Cadastro efetuado com sucesso. Seu usuário é: "". Agora é hora de cadastrar uma senha:</h3>
		
				<div class="form-group col-lg-8 col-md-4">
					<label for="senha">Senha</label>
    				<input type="password" class="form-control" id="senha" placeholder="Digite sua senha...">
				</div>

				<div class="form-group col-lg-8 col-md-4">
					<label for="confsenha">Confirmar Senha</label>
    				<input type="password" class="form-control" id="confsenha" placeholder="Digite novamente sua senha...">
				</div>

				<div class="form-group col-lg-8 col-md-4">
					<button type="submit" class="btn btn-primary">Cadastrar esta senha</button>
				</div>

			</form>

			
			</div> <!-- /container -->

		</div>
</div>
<?php include_once("partials/bottom.php"); ?>