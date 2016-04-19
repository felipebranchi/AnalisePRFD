<?php 

// Inclui o arquivo com a classe de login
//require_once("../classes/sessao.class.php");
include_once("../classes/app.php");

// Instancia a classe
$sessionClass = new Sessao();
?>
<?php include_once("partials/head.php"); ?>
<?php include_once("partials/navbar.php"); ?>

	    <div id="container-bg" class="container text-center">
	        <div id="content-form" class="container text-justify">
				<div class="row">
					<div id="content-title col-md-12 col-sm-12 col-xs-6">
						<H2>Contato</H2><br>
						<h4>Dúvidas ou sugestões? Contate-nos!</h4><br>
					</div>
				</div>
				<div class="row">
					<form method="POST" action="mail-pt.php">
						<div id="coluna1" class="col-md-6 col-sm-5 col-xs-12">
							<div class="form-group">
								<label>Nome:</label>
								<input id="nome" class="form-control" required name="nome" type="text"/>
							</div>
							<div class="form-group">
								<label>E-mail:</label>
								<input id="email" class="form-control" required name="email" type="text"/>
							</div>
							<div class="form-group">
								<label>Mensagem:</label>
								<textarea id="obs" class="form-control" required name="obs" rows="5"></textarea>
							</div>
							<div id="button-sub" class="form-group">
								<button type="submit" class="btn btn-primary btn-lg" onsubmit="submete();">Enviar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
<?php include_once("partials/bottom.php"); ?>
