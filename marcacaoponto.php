<?php

//Iniciando a sessão:
if (session_status() !== PHP_SESSION_ACTIVE) {

    session_cache_expire(600);

    session_start();
}


require 'check.php';

require_once 'init.php';


//VERIFICA SE O TEMPO DE LOGIN E MAIOR QUE 12H
if (time() >= $_SESSION['logout_time']) {

    header("location:logout.php");
}



include './menu.php';




//VARIAVEIS DE SESSAO
$usuario = $_SESSION['user_name'];

$nome = $_SESSION['nome_completo'];

$tipo = $_SESSION['tipo'];

$abreviacao = $_SESSION['abreviacao'];

$nivel = $_SESSION['nivel'];

$img = $_SESSION['img'];

$id_user = $_SESSION['user_id'];



//CHAMADA DE FUNÇÃO QUE IRÁ RETORNA OS USUARIOS DO BANCO DE DADOS
$usuarios = retornaUsuarios();


?>

<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="css/Lobibox.min.css">

    <link rel="stylesheet" href="css/notifications.css">

    <link rel="stylesheet" href="style.css">

</head>

<div class="content-inner-all">

    <body class="materialdesign">

        <div class="income-order-visit-user-area">

            <div class="container-fluid">

                <div class="row">
                    <br>
                    <!-- TABELA DE COLABORADORES!-->
                    <div class="col-lg-12">
                        <div class="sparkline12-hd">
                            <div class="main-sparkline12-hd">
                                <h1>Registro de Ponto</h1>
                                <div class="sparkline12-outline-icon">
                                </div>
                            </div>
                        </div>
                        <div class="sparkline12-graph">
                            <div class="static-table-list">
                                <h1></h1>
                            </div>

                            <div>
                                <span id='clock'> </span>
                            </div>

                            <div>
                                <span id='data'> </span>
                            </div>


                            <div>
                                <button type="submit" class="btn btn-primary" id="botaoponto">Marcar ponto</button>
                            </div>
                            <br>
                            <div>
                                <a href="#">Ver historico</a>
                            </div>

                        </div>
                    </div>
                </div>

                <br>
            </div>
        </div>
</div>


<!-- SCRIPTS UTILIZADOS NO DASHBOARD !-->
<script src="js/vendor/jquery-1.11.3.min.js"></script>

<script src="js/marcacaoponto.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.meanmenu.js"></script>

<script src="js/counterup/jquery.counterup.min.js"></script>

<script src="js/counterup/waypoints.min.js"></script>

<script src="js/counterup/counterup-active.js"></script>

<script src="js/sparkline/jquery.sparkline.min.js"></script>

<script src="js/sparkline/sparkline-active.js"></script>

<script src="js/chosen/chosen.jquery.js"></script>

<script src="js/chosen/chosen-active.js"></script>

<script src="js/preloader.js"></script>

<script src="js/Lobibox.js"></script>

<script src="js/vendor/jquery-1.11.3.min.js"></script>

<script src="js/jquery.meanmenu.js"></script>

<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="js/jquery.sticky.js"></script>

<script src="js/jquery.scrollUp.min.js"></script>

<script src="js/notification-active.js"></script>

<script src="js/main.js"></script>

</body>

</html>