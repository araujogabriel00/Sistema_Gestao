<?php 
session_start();
// inclui o arquivo de inicialização

require 'check.php';
require_once 'init.php';


$hora = $_POST['mostrarHora'];
$id_user = $_SESSION['user_id'];


marcacaoPonto($id_user, $hora);

?>