<?php

require 'init.php';

require 'check.php';

//RECEBE O ID DO USUARIO QUE DESLOGOU
$id_usuario_p_deslogar = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//CHAMADA DE FUNÇÃO PARA DESLOGAR O USER DA FERRAMENTA
updateLogado($id_usuario_p_deslogar['id'],2);
