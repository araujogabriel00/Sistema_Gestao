<?php

 

require_once 'init.php';

 
//SE O USER NÃO ESTIVER LOGADO RETORNA PARA A PÁGINA DE LOGIN
if (!isLoggedIn())

{

    header('Location: login.html');

}

?>