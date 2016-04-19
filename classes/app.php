<?php
try {
    require_once('../configuration.php');
    $Configuration = new Configuration();
} catch (Exception $ex) {
    print_r($ex);
}

if ($Configuration->debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
define('APP_ROOT', dirname(__DIR__));
define('LIB_ROOT', __DIR__);


$conexao = @mysql_connect($Configuration->dbhostname, $Configuration->dbusername, $Configuration->dbpassword);
include_once("sessao.class.php");


// @todo refratorar este arquivo para que ele tenha uma classe, por exemplo, 
//       "App", e usar uma aproximacao mais OOP
