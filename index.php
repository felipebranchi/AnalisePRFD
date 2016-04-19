<?php

namespace views;

 #abaixo, criamos uma variavel que terá como conteúdo o endereço para onde haverá o redirecionamento:  
 $redirect = "views/index.php";
 
 #abaixo, chamamos a função header() com o atributo location: apontando para a variavel $redirect, que por 
 #sua vez aponta para o endereço de onde ocorrerá o redirecionamento
 header("location:$redirect");

?>