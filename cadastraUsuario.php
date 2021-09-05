<?php
session_start();
// inclui o arquivo de inicialização
require_once 'init.php';
require 'check.php';


///VARIAVEIS QUE RECEBERÃO OS VALORES PASSADOS NO REGISTRO.PHP
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$senha =$_POST['password'];
$confirme_password =$_POST['confirme_password'];
$opcao =$_POST['opcao'];
$registroAcademico = $_POST['registroAcademico'];
$opcaoSemestre = $_POST['opcaoSemestre'];



//CHAMADA DA FUNCÃO QUE IRÁ INSERIR O DADOS NO BANCO
registrarUsuario($nome." ".$sobrenome,$opcaoSemestre, $registroAcademico,$email,sha1(md5($senha)),$opcao);

//DESTROY VARIAVEIS
unset($nome);
unset($email);
unset($senha);
unset($confirme_password);
unset($opcao);
