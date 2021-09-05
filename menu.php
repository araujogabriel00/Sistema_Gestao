<!DOCTYPE html>

<?php

require_once 'init.php';
require 'check.php';

///REALIZA CONEXÃO COM BANCO DE DADOS E PEGA AS INFORMAÇÕES DO USUARIO UTILIZADO O $_SESSION['user_id'] COMO PARAMETRO
$PDO = db_connect();
$sql = "SELECT id, usuario,nome_completo,nivel,tipo,concat(left(nome_completo,1),left(TRIM(SUBSTR(nome_completo, LOCATE(' ',nome_completo)) ),1)) as abreviacao,logado,img FROM users WHERE id = :id_user";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id_user', $_SESSION['user_id']);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


//LER O ARRAY E VERIFICA SE ESTA VAZIOU OU NÃO
foreach ($users as $u) {
    $usuarioMenu = isset($u['usuario']) ? $u['usuario'] : '';
    $nomeMenu = isset($u['nome_completo']) ? $u['nome_completo'] : '';
    $tipoMenu = isset($u['tipo']) ? $u['tipo'] : '';
    $abreviacaoMenu = isset($u['abreviacao']) ? $u['abreviacao'] : '';
    $nivelMenu = isset($u['nivel']) ? $u['nivel'] : '';
    $imgMenu = isset($u['img']) ? $u['img'] : '';
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/adminpro-custon-icon.css">
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/select2/select2.min.css">
    <link rel="stylesheet" href="css/chosen/bootstrap-chosen.css">
    <link rel="stylesheet" href="css/preloader/preloader-style.css">
</head>

<body>

    <!-- Pre Loader-->
    <div class="preloader-wrapper">
        <div class="preloader" id="ts-preloader-absolute30">
            <div id="absolute30">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
    </div>

    <!-- MENU LATERAL-->
    <div class="left-sidebar-pro">
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="index.php"><?php echo '<img src="' . $imgMenu . '" alt=""/' ?></a>
                <h3 class="admin-name"><?php echo $nomeMenu ?></h3>
                <p><?php echo  strtoupper($tipoMenu) ?></p>
                <strong><?php echo $abreviacaoMenu ?></strong>
            </div>
            <div class="left-custom-menu-adp-wrap">
                <ul class="nav navbar-nav left-sidebar-menu-pro">
                    <li class="nav-item">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><strong></span></a>

                    </li>
                    <!-- Itens menu vertical -->
                    <li class="nav-item">
                       

                    </li>

                </ul>
            </div>
        </nav>
    </div>

    <!-- MENU SUPERIOR-->
    <div class="header-top-area">
        <div class="fixed-header-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12">
                        <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="admin-logo logo-wrap-pro">
                            <a href="index.php"><img src="img/logo/log.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
                        <div class="header-top-menu">
                            <ul class="nav navbar-nav mai-top-nav">

                                <?php
                                //A OPÇÃO DE ACESSO À PAGINA DE REGISTRO SOMENTE SERÁ OFERTADA A AQUELES QUE POSSUIREM NIVEL TIPO 1
                                if ($nivelMenu == 1) {
                                    echo '
                                    <li class="nav-item dropdown">
                                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">Admin <span class="angle-down-topmenu"><i class="fa fa-angle-down"></i></span></a>
                                        <div role="menu" class="dropdown-menu animated flipInX">
                                            <a href="registro.php" class="dropdown-item">Criar Usuario</a>
                                        </div>
                                    </li>';
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                        <div class="header-right-info">
                            <ul class="nav navbar-nav mai-top-nav header-right-menu">

                                <li class="nav-item">
                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                        <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                                        <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                                    </a>
                                    <ul style="right: 0; left: auto;" role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                                        <li><a href="logout.php"><span class="adminpro-icon adminpro-locked author-log-ic"></span>Encerrar</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>