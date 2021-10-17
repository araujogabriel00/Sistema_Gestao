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

function verificaPontoEntrada($id)
{

    $dia = date("Y-m-d");
    $PDO = db_connect();
    $sql = "SELECT dia, entrada  FROM sistema.marcacao_ponto WHERE fk_id_user = :id  and dia = :dia";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':dia', $dia);
    $stmt->execute();
    $pontos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dadosCodificados = json_encode($pontos);
    $objData = json_decode($dadosCodificados);
    return $objData;
}


function verificaPonto($id)
{

    $dia = date("Y-m-d");
    $PDO = db_connect();
    $sql = "SELECT dia, almoco, volta, entrada FROM sistema.marcacao_ponto WHERE fk_id_user = :id  and dia = :dia";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':dia', $dia);
    $stmt->execute();
    $pontos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dadosCodificados = json_encode($pontos);
    $objData = json_decode($dadosCodificados);
    //VERIFICA SE TEM ALGUMA MARCAÇÃO
    if (empty($objData)) {
        return 1;
    } else {
        foreach ($objData as $horario) {
            if ($horario->almoco == null) {
                return 2;
            } elseif ($horario->volta == null) {
                return 3;
            } else {
                return 4;
            }
        }
    }
}

function horasTrabalhadasMensal($id)
{
    $PDO = db_connect();
    $sql = "SELECT
    dia, 
    format(TIMESTAMPDIFF(minute,entrada, almoco)/60,2) as pPeriodo,
    format(TIMESTAMPDIFF(minute,volta,saida)/60, 2) as  fPeriodo,
    (SELECT fPeriodo+pPeriodo) as HorasTrabalhadasDia
    from marcacao_ponto where fk_id_user = :id and month(dia) = month(current_date());";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $pontos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dadosCodificados = json_encode($pontos);
    $objData = json_decode($dadosCodificados);

    return $objData;
}


function marcacaoPonto($id)
{
    $PDO = db_connect();
    $dia = date("Y-m-d");

    if (verificaPonto($id) == 1) {
        $sql = "INSERT INTO marcacao_ponto (fk_id_user, dia, entrada) VALUES (:id, :dia, now());";
    } elseif (verificaPonto($id) == 2) {
        $sql = "UPDATE marcacao_ponto SET almoco = now() WHERE fk_id_user = :id AND dia = :dia";
    } elseif (verificaPonto($id) == 3) {
        $sql = "UPDATE marcacao_ponto  SET volta = now() WHERE fk_id_user = :id AND dia = :dia";
    } else {
        $sql = "UPDATE marcacao_ponto  SET saida = now() WHERE fk_id_user = :id AND dia = :dia";
    }
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':dia', $dia);
    $stmt->execute();
}


function apiCalendario($dia)
{
    $url = "https://api.calendario.com.br/
        ?json=true&ano=2021&ibge=5300108&token=Z2FicmllbC5hcmF1am9zQHNlbXByZWNldWIuY29tJmhhc2g9MTQ4OTcxNzA1";
    $resultado = json_decode(file_get_contents($url));
    $eFeriado = null;
    foreach ($resultado as $feriados) {
        if ($feriados->date == $dia) {
            $eFeriado = true;
        }
    }
    return $eFeriado;
}

//LER TODOS OS USER DO BANCO
function retornaUsuarios()
{
    $PDO = db_connect();
    $sql = "SELECT id,nome_completo,RA,semestre, usuario, img 
    FROM sistema.users 
    order by nome_completo ASC;";
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

function retonaPontoPorId($id_user, $inicio, $qnt_result_pg)
{
    $PDO = db_connect();
    $sql =
        "SELECT 
        dia, entrada, almoco, volta, saida 
    FROM sistema.marcacao_ponto 
        where fk_id_user = :id_user
        and month(dia) = month(current_date()) 
        ORDER BY id ASC LIMIT $inicio, $qnt_result_pg";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id_user', $id_user);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dadosCodificados = json_encode($user);
    $dadosUsuario = json_decode($dadosCodificados);
    return $dadosUsuario;
}

function motivoReprovacao($dia, $motivo, $userQueReprovou, $userQueTeveOPontoReprovado)
{
    $PDO = db_connect();
    $sql =
        "INSERT INTO sistema.folhasreprovadas
        (gestor,colaborador,dia,motivo,mes)
    VALUES 
        (:gestor,:colaborador,:dia,:motivo,month(current_date()));";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':gestor', $userQueReprovou);
    $stmt->bindValue(':colaborador', $userQueTeveOPontoReprovado);
    $stmt->bindValue(':dia', $dia);
    $stmt->bindValue(':motivo', $motivo);
    $stmt->execute();
}

function retonaPontoPorIdFuncionario($id_user)
{
    $PDO = db_connect();
    $sql = "SELECT dia, entrada, almoco, volta, saida FROM sistema.marcacao_ponto where fk_id_user = :id_user
    and month(dia) = month(current_date());";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id_user', $id_user);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dadosCodificados = json_encode($user);
    $dadosUsuario = json_decode($dadosCodificados);
    return $dadosUsuario;
}


function retonaPontoPorIdFuncionarioMes($id_user, $mes)
{
    $PDO = db_connect();
    $sql = "SELECT dia, entrada, almoco, volta, saida FROM sistema.marcacao_ponto where fk_id_user = :id_user
    and month(dia) = :mes;";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id_user', $id_user);
    $stmt->bindValue(':mes', $mes);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dadosCodificados = json_encode($user);
    $dadosUsuario = json_decode($dadosCodificados);
    return $dadosUsuario;
}

function retonaQtdLinhaPontoPorId($id_user)
{
    $PDO = db_connect();
    $sql = "SELECT count(fk_id_user) as qtd FROM sistema.marcacao_ponto where fk_id_user = :id_user";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id_user', $id_user);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dadosCodificados = json_encode($user);
    $qtdLinhas = json_decode($dadosCodificados);
    return $qtdLinhas;
}


function retonaInfoFuncionarioPorId($id_user)
{
    $PDO = db_connect();
    $sql = "SELECT usuario, RA, semestre, nome_completo, img, tipo FROM users where id = :id_user";
    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id_user', $id_user);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dadosCodificados = json_encode($user);
    $objData = json_decode($dadosCodificados);
    return $objData;
}
