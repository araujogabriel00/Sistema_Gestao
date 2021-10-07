<?php

//Iniciando a sessão:

use function PHPSTORM_META\type;

session_start();

if (!isset($_SESSION['start_login'])) { // se não tiver pego tempo que logou

    $_SESSION['start_login'] = time(); //pega tempo que logou

    $_SESSION['logout_time'] = $_SESSION['start_login'] + 3600 * 12; // adiciona 12 horas ao tempo e grava em outra variável de sessão!

}




require 'check.php';
require_once 'init.php';
include './menu.php';





//VERIFICA SE O TEMPO DE LOGIN E MAIOR QUE 12H
if (time() >= $_SESSION['logout_time']) {

    header("location:logout.php");
}


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

$id_consulta = $_POST['consultaPonto'];

$id_user_ponto = retonaInfoFuncionarioPorIdTEste($id_consulta);

$id__user_consulta_info = retonaInfoFuncionarioPorId($id_consulta);

$horasTrabalhadasMensal = horasTrabalhadasMensal($id_user);
$totalhorasTrabalhadasMensal = 0;





?>

<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="css/Lobibox.min.css">
    <link rel="stylesheet" href="css/notifications.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/c3.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body class="materialdesign">
    <div class="content-inner-all">
        <div class="income-order-visit-user-area">
            <div class="container-fluid">
                <div class="row">
                    <br>
                    <!-- TABELA DE COLABORADORES!-->
                    <div class="user-profile-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="user-profile-wrap shadow-reset">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="user-profile-img">
                                                <?php foreach ($id__user_consulta_info as $infoUser) {} ?>
                                                    <img src=<?= $infoUser->img?> alt="" />
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="user-profile-content">
                                                    <h2><strong><?= $infoUser->nome_completo?></strong></h2>
                                                    <p class="profile-founder"><strong>SEMESTRE: <?=$infoUser->semestre?>º</strong>
                                                    <p class="profile-founder"><strong>RA: <?=$infoUser->RA?></strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                    <?php foreach (horasTrabalhadasMensal($id_user) as $key) {
                                        $totalhorasTrabalhadasMensal += $key->HorasTrabalhadasDia;
                                    }
                                   ;
                                    
                                    ?>
                                        <div class="analytics-sparkle-line user-profile-sparkline">
                                            <div class="analytics-content">
                                                <h5><strong>Horas Trabalhadas este mês</strong></h5>
                                                <h2 class="counter"><?=$totalhorasTrabalhadasMensal?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <br>
                    <div class="col-lg-12">
                        <div class="sparkline12-hd">
                            <div class="main-sparkline12-hd">
                                <h1> Marcações Realizadas
                                </h1>
                                <div class="sparkline12-outline-icon">
                                </div>
                            </div>
                        </div>
                        <br>
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
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/notification-active.js"></script>
    <script src="js/main.js"></script>
    <script src="js/c3-charts/d3.min.js"></script>
    <script src="js/c3-charts/c3.min.js"></script>
    <script src="js/c3-charts/c3-active.js"></script>
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="js/notification-active.js"></script>
</body>

</html>