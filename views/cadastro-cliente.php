<?php
include_once("../classes/app.php");

// Instancia a classe
$sessionClass = new Sessao();

include_once("partials/head.php");
include_once("partials/navbar.php"); ?>

<div class="container">
    <div class="col-lg-8">
        <div id="titleposition" class="page-header">
            <h1>Dados Pessoais</h1>
        </div>

        <div class="container col-lg-8">
            <form method="POST" action="" enctype="multipart/form-data">
                <h3>Preencha os campos abaixo.</h3>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf">
                </div>
                <br>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome">
                </div>
                <br>

                <div class="form-group col-lg-8 col-md-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email">
                </div>
                <br>

                <div class="form-group col-lg-8 col-md-4">
                    <label for="nascimento">Data nascimento</label>
                    <input type="date" class="form-control" id="nascimento">
                </div>
                <br>

                <div class="form-group col-lg-8 col-md-4">
                    <label for="DDD">DDD</label>
                    <input type="text" class="form-control" id="ddd" placeholder="DDD">
                </div>
                <br>
                
                <div class="form-group col-lg-8 col-md-4">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="form-control" id="telefone" placeholder="Telefone">
                </div>
                <br>
                
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