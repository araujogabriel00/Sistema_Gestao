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
                    <div class="user-profile-area">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="user-profile-wrap shadow-reset">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <?php
                                                        foreach ($id__user_consulta_info as $info_funcionarios) {
                                                            echo '<div class="user-profile-img">
                                                            <img src="' . $info_funcionarios->img . '" alt="" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="user-profile-content">
                                                        
                                                                <h2>' . $info_funcionarios->nome_completo . '</h2>
                                                            
                                                            <p class="profile-founder">
                                                            <strong>' . strtoupper($info_funcionarios->tipo) . '</strong><br>
                                                            <strong> RA: ' . strtoupper($info_funcionarios->RA) . '</strong><br>
                                                            <strong> SEMESTRE: ' . strtoupper($info_funcionarios->semestre) . '°</strong>
                                                            </p>
                                                            
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                ';
                                                        }

                                                        ?>
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
                                            <h1> Marcações Realizadas <span class="badge">Total: <?= $id_user_ponto[2] ?></span></h1>
                                            <div class="sparkline12-outline-icon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sparkline12-graph">
                                        <div class="static-table-list">
                                            <table class="table table-bordered" >
                                            <input type="hidden" id="dados_tabela" value="'.$dia = $key->dia.'" onload="montarTabela()"></input>
                                            <?php
                                            
                                                
                                                $dia;
                                                $hora;
                                                foreach ($id_user_ponto[0] as $key) {
                                                    $dia = $key->dia;
                                                    echo'';
                                                }
                                                var_dump($dia)?>
                                                
                                                <thead >
                                                    <tr>
                                                        <th>Dia</th>
                                                        <th>Hora</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $pontos = $id_user_ponto[0];
                                                    foreach ($pontos as $pontos_marcados) { ?>
                                                        <tr>
                                                            <td><?= $pontos_marcados->dia; ?></td>
                                                            <td><?= $pontos_marcados->hora; ?></td>
                                                            <?php
                                                            /*
                                                            $refPerson = $db->prepare("SELECT nome_completo FROM users where id=$result->id");
                                                            $refPerson->execute();
                                                            $refPerson = $refPerson->fetch(PDO::FETCH_OBJ); */
                                                            ?>
                                                        </tr>
                                                    <?php $no = $id_user_ponto[5]++;
                                                    } ?>
                                                </tbody>
                                            </table>
                                            <ul class="pagination">
                                                <li><a href="?page=1">Primeira</a></li>
                                                <?php
                                                $total_de_linhas_por_pagina = $id_user_ponto[3];
                                                for ($pagina = 1; $pagina <= $total_de_linhas_por_pagina; $pagina++) { ?>

                                                    <li class="<?= $page = $id_user_ponto[6]  == $pagina ? 'active' : ''; ?>">
                                                        <a href="<?= '?page=' . $pagina; ?>"><?= $pagina; ?></a>
                                                    </li>
                                                <?php }  ?>
                                                <li>
                                                    <a href="?page=<?= $total_de_linhas_por_pagina ?>">Última</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
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