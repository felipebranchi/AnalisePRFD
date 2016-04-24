
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Alternar navegação</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img id="navicon" src="../images/icon.png">
      <a class="navbar-brand">Cutree</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Início</a></li>
        <li><a href="contato.php">Contato</a></li>

        <?php

          // Verifica se há um usuário logado
          if ( $sessionClass->usuarioLogado() === true ) {
            echo 

            '<li><a href="alterar-cadastro.php">Alterar cadastro</a></li>
                
            <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Árvores<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="solicitacao-poda.php">Poda</a></li>
                <li><a href="solicitacao-remocao.php">Remoção</a></li>
              </ul>
            </li>

            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Lixo<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="solicitacao-lixo-comum.php">Remoção comum</a></li>
                      <li><a href="solicitacao-lixo-hospitalar.php">Remoção de hospitalar</a></li>
                      <li><a href="solicitacao-lixo-entulho.php">Remoções de entulho</a></li>
                    </ul>
                  </li>';
          }
        ?>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        // Verifica se há um usuário logado
        if ($sessionClass->usuarioLogado() === true) {

            ?> <li><a href="meus-dados.php"> <?php echo ucfirst($_SESSION['usuario_nome']); ?> </a></li> <?php;

            ?> <li><a href="logout.php">Logout</a></li>
            <?php
        } else {
            echo '<li><a href="login.php">Login</a></li>';
        }

        ?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>