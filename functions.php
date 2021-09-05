<?php

/**
 * Conecta com o MySQL usando PDO
 */
function db_connect()
{
    try {
        $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        return $PDO;
    } catch (PDOException $th) {
        echo "Error: " . $th->getMessage();
    }
}

/**
 * Cria o hash da senha, usando MD5 e SHA-1
 */
function make_hash($str)
{
    return sha1(md5($str));
}

/**
 * Verifica se o usuário está logado
 */
function isLoggedIn()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        return false;
    }
    return true;
}

// insert no campo logado como logado ou deslogado
function updateLogado($id, $operacao)
{
    switch ($operacao) {
        case 1:
            $PDO = db_connect();
            $sql = "UPDATE users set logado = 1, ultimo_login =now(),ultimo_logout=null where id = :id";
            $stmt = $PDO->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            break;
        case 2:
            $PDO = db_connect();
            $sql = "UPDATE users set logado = 0, ultimo_logout =now() where id = :id";
            $stmt = $PDO->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            break;
    }
}

//INSERIR O ID DA SESSÃO, O ID DO USUARIO PARA INICIAR A SESSÃO
function sessaoLogin($id, $sessao)
{
    $PDO = db_connect();
    $sql = "INSERT INTO sessao (id_sessao, id_user,login) VALUES (:sessao, :id , now())";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':sessao', $sessao);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

///REPONSAVEL POR FAZER A ATUALIZAÇÃO DA SESSAO QUANDO O USARIO DESLOGA DO SISTEMA
function sessaoLogout($id, $sessao)
{
    $PDO = db_connect();
    $sql = "UPDATE sessao set logout= now() where id_sessao = :sessao and id_user = :id ";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':sessao', $sessao);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

/* Aqui Faço Input no banco de dados do novo usuario */

function registrarUsuario($nomeCompleto, $semestre, $registroAcademico, $email, $senha, $perfil)
{
    $PDO = db_connect();
    $sql = "INSERT INTO sistema.users (usuario, `password`, dataCriacao, RA, semestre, nome_completo, nivel,img) VALUES (:usuario, :senha, now(),:RA , :semestre, :nomeCompleto, :perfil,'img/message/1.jpg');";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':usuario', $email);
    $stmt->bindValue(':senha', $senha);
    $stmt->bindValue(':nomeCompleto', $nomeCompleto);
    $stmt->bindValue(':perfil', $perfil);
    $stmt->bindValue(':RA', $registroAcademico);
    $stmt->bindValue(':semestre', $semestre);
    $stmt->execute();
}



// function que define o horario de funcionamento do sistema
function podeEntrar($nivel)
{
    if ($nivel === 3) {
        return true;
    }
    if (date('H:m', time()) < strtotime('16:00')) {
        return 'Erro';
    }
}

//LER TODOS OS USER DO BANCO
function retornaUsuarios()
{
    $PDO = db_connect();
    $sql = "SELECT id,nome_completo,RA,semestre, usuario, img FROM sistema.users order by nome_completo ASC;";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $usersKeyName = array();
    foreach ($users as $user) {
        $usersKeyName[trim($user['nome_completo'])] = $user;
    }
    $dadosCodificados = json_encode($usersKeyName);
    $objData = json_decode($dadosCodificados);
    return $objData;
}
