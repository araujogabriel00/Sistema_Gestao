<?php

session_start();
//CHECA SE O NIVEL DE SESSÃO E DIFERENTE DE 1, SOMENTE ADM TEM NÍVEL 1
if ($_SESSION['nivel'] != 1) {
    header('Location: index.php');
}

//ARQUIVOS DE INICIALIZAÇÃO
include_once './menu.php';
require_once 'init.php';

//VERIFICA SE O TEMPO DE LOGIN JÁ ULTRAPASSOU 12H
if (time() >= $_SESSION['logout_time']) {
    header("location:logout.php");
}

///PEGA AS VARIAVEIS DE SESSÃO
$usuario = $_SESSION['user_name'];
$nome = $_SESSION['nome_completo'];
$tipo = $_SESSION['tipo'];
$abreviacao = $_SESSION['abreviacao'];
$img = $_SESSION['img'];



?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Lobibox.min.css">
    <link rel="stylesheet" href="css/notifications.css">
</head>

<body class="materialdesign">
    <div class="content-inner-all">
        <!-- TABELA DE REGISTRO DE USUARIOS-->
        <div class="login-form-area mg-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <form id="registro_form" class="adminpro-form" action="cadastraUsuario.php" method="post">
                        <div class="col-lg-6">
                            <div class="login-bg">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="login-title">
                                            <h1>Cadastrar Usuario</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Nome/Sobrenome</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="login-input-area register-mg-rt">
                                                    <input type="text" name="nome" id="nome" placeholder="Nome unico" />
                                                    <i class="fa fa-user login-user"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="login-input-area">
                                                    <input type="text" name="sobrenome" id="sobrenome" maxlength="10" placeholder="Sobrenome" />
                                                    <i class="fa fa-user login-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>RA</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="login-input-area register-mg-rt">
                                                    <input type="text" name="registroAcademico" id="registroAcademico" placeholder="Registro Acadêmico" />
                                                    <i class="fa fa-user login-user"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Semestre</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="login-input-area register-mg-rt">
                                                    <select id="opcaoSemestre" name="opcaoSemestre" class="select2_demo_2 col-lg-12 ">
                                                        <option selected value="1">1°</option>
                                                        <option value=2>2°</option>
                                                        <option value=3>3°</option>
                                                        <option value=4>4°</option>
                                                        <option value=5>5°</option>
                                                        <option value=6>6°</option>
                                                        <option value=7>7°</option>
                                                        <option value=8>8°</option>
                                                        <option value=9>9°</option>
                                                        <option value=10>10°</option>
                                                        <option value=11>11°</option>
                                                        <option value=12>12°</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p><i>nome@sistema.com.br</i></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="email" name="email" id="email" placeholder="nome@sistema.com.br" />
                                            <i class="fa fa-envelope login-user" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Senha</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="password" name="password" id="password" />
                                            <i class="fa fa-lock login-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Confirme a senha</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <input type="password" name="confirme_password" id="confirme_password" />
                                            <i class="fa fa-lock login-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="login-input-head">
                                            <p>Escolha o Perfil</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="login-input-area">
                                            <label class="radio">
                                                <input type="radio" name="opcao" value="1"><i></i>Admin
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="opcao" value="2"><i></i>Aluno
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <div class="login-button-pro">
                                            <button type="reset" class="login-button login-button-rg" id="limpar">Limpar</button>
                                            <button type="submit" class="login-button login-button-lg" id="registrar">Registrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>

    </div>



    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.meanmenu.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/peity/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.form.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/form-active.js"></script>
    <script src="js/Lobibox.js"></script>
    <script src="js/meu_ajax/ajax.js"></script>
    <!--- RESPONSAVEL POR FAZER A VERIFICAÇÕES E ENVIO À PAGINA cadastraUsuario.php!-->
    <script src="js/preloader.js"></script>
    <script src="js/notification-active.js"></script>
    <script src="js/select2/select2.full.min.js"></script>
    <script src="js/select2/select2-active.js"></script>
</body>

</html>