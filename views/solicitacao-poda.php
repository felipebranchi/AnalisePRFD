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

<div class="container">
    <div class="col-lg-8">
        <div id="titleposition" class="page-header">
            <h1>Solicitação de Poda de Árvore</h1>
        </div>

        <div class="container col-lg-8">
            <form method="POST" action="" enctype="multipart/form-data">
                <h3>Insira o endereço onde a árvore se encontra.</h3>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" placeholder="CEP">
                </div>
                <br>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="uf">UF</label>
                    <input type="text" class="form-control" id="uf" placeholder="UF">
                </div>
                <br>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" placeholder="Cidade">
                </div>
                <br>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" placeholder="Bairro">
                </div>
                <br>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="endereco" placeholder="Endereço">
                </div>
                <br>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="endereco_complemento">Complemento</label>
                    <input type="text" class="form-control" id="endereco_complemento" placeholder="Complemento">
                </div>
                <br>
                
                <div class="form-group col-lg-10 col-md-4">
                    <button type="submit" id="subm" class="btn btn-success">Enviar</button>
                </div>
            </form>


        </div> <!-- /container -->
    </div>
</div>

<?php include_once("partials/bottom.php"); ?>

?>