<?php

 

// define valores padrão para diretivas do php.ini

ini_set( 'error_reporting', -1 );

ini_set( 'display_errors', 1 ); // deve ser definida para zero (0) em ambiente de produção

 

// timezone
date_default_timezone_set( 'America/Sao_Paulo' );

 

// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sistema');



 
// habilita todas as exibições de erros

ini_set('display_errors', true);

error_reporting(E_ALL);

 

// inclui o arquivo de funçõees

require_once 'functions.php';







?>