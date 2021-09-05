<?php



require 'init.php';

// inicia a sessão

session_start();

 

// muda o valor de logged_in para false

$_SESSION['logged_in'] = false;

 
//DESLOGA O USER
updateLogado($_SESSION['user_id'],2);

//INSERIR NO BANCO QUANDO O USER FEZ O ÚLTIMO LOGOUT
sessaoLogout($_SESSION['user_id'], session_id());





///Apagando todos os dados da sessão:

session_unset();//Destruindo a sessão:

session_destroy();



// retorna para a index.php

header('Location: login.html');





?>