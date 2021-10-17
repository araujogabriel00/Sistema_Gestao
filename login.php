<?php

// inclui o arquivo de inicialização
require 'init.php';


// resgata variáveis do formulário
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


// cria o hash da senha
$passwordHash = make_hash($password);

//CRIA CONEXÃO COM O BANCO DE DADOS
$PDO = db_connect();
$sql = "SELECT id, usuario,nome_completo,nivel,tipo,concat(left(nome_completo,1),left(TRIM(SUBSTR(nome_completo, LOCATE(' ',nome_completo)) ),1)) as abreviacao,logado,img FROM users WHERE usuario = :usuario AND password = :password";
$stmt = $PDO->prepare($sql); // Prepara uma instrução SQL a ser executada pelo método PDOStatement :: execute () . stmt Representa uma instrução preparada e, após a instrução ser executada, um conjunto de resultados associado.
$stmt->bindParam(':usuario', $usuario); //Vincula um parâmetro ao nome da variável especificada
$stmt->bindParam(':password', $passwordHash);// PDOStatement :: bindParam () e / ou PDOStatement :: bindValue () deve ser chamado para vincular variáveis ​​ou valores (respectivamente) aos marcadores de parâmetro. Variáveis ​​associadas passam seu valor como entrada e recebem o valor de saída, se houver, de seus marcadores de parâmetro associados
$stmt->execute();// Execute a declaração preparada . Se a declaração preparada incluiu marcadores de parâmetro:
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);// pega o primeiro usuário

//SE O LOGIN ESTIVER INCORRETO MOSTRAR UM ALERT DEPOIS RETORNA A PAGINA DE LOGIN
if (count($users) <= 0) {
    echo ("<script>alert('Login incorreto'); location.href='login.html';</script>");
    exit;
//SE O LOGIN ESTIVER CORRETO IRÁ CARREGAR A PAGINA INICIAL E ATUALIZAR A COLUNA LOGADO NO BANCO DE DADOS
} else {
    $user = $users[0];
    if ($user['logado'] == 0) {
        updateLogado($user['id'], 1);
    } else {
        //USUARIO PASSOU DAS 12H PERMITIDAS
        echo ("<script>alert('Usuario já Logado favor deslogar da estação\Usuario fora do Horario de uso da ferramenta!'); location.href='login.html';</script>");
        exit;
    }

    session_start();
    if (!isset($_SESSION['start_login'])) { // se não tiver pego tempo que logou
        $_SESSION['start_login'] = time(); //pega tempo que logou
        $_SESSION['logout_time'] = $_SESSION['start_login'] + 3600 * 12; // adiciona 12 horas ao tempo e grava em outra variável de sessão!
    }

    //VARIVEIS DE SESSAO
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['usuario'];
    $_SESSION['nome_completo'] = $user['nome_completo'];
    $_SESSION['nivel'] = $user['nivel'];
    $_SESSION['tipo'] = $user['tipo'];
    $_SESSION['abreviacao'] = $user['abreviacao'];
    $_SESSION['logado'] = $user['logado'];
    $_SESSION['img'] = $user['img'];

    session_regenerate_id(true); //zerando o id da sessão
    sessaoLogin($user['id'], session_id()); // gravando login


    if ($_SESSION['nivel'] != 1) {
        header('Location: marcacaoponto.php');
    }else{
        header('Location: listaFucionarios.php');
    }
    
}





