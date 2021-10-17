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



//VARIAVEIS DE SESSAO
$usuario = $_SESSION['user_name'];

$nome = $_SESSION['nome_completo'];

$tipo = $_SESSION['tipo'];

$abreviacao = $_SESSION['abreviacao'];

$nivel = $_SESSION['nivel'];

$img = $_SESSION['img'];

$id_user = $_SESSION['user_id'];



$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

//consultar no banco de dados

$dadosUsuario = retonaPontoPorId($id_user, $inicio, $qnt_result_pg);
$qtdLinhas = retonaQtdLinhaPontoPorId($id_user);

foreach ($qtdLinhas as $linhas) {
}
//Verificar se encontrou resultado na tabela "usuarios"
if (($dadosUsuario) and ($linhas->qtd != 0)) {
?>
    <div class="sparkline12-graph">
        <div class="static-table-list">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Dia</th>
                        <th>Entrada</th>
                        <th>Almoço</th>
                        <th>Volta</th>
                        <th>Saída</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dadosUsuario as $info) {
                        $date = new DateTime($info->dia);
                    ?>
                        <tr>
                            <th><?php echo $date->format("d/m/Y")?></th>
                            <td><?php echo substr($info->entrada, 11, 15)?></td>
                            <td><?php echo substr($info->almoco, 11, 15) ?></td>
                            <td><?php echo substr($info->volta, 11, 15) ?></td>
                            <td><?php echo substr($info->saida, 11, 15) ?></td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
<?php
    //Quantidade de pagina
    $quantidade_pg = ceil($linhas->qtd / $qnt_result_pg);

    //Limitar os link antes depois
    $max_links = 2;

    echo "<button class='btn btn-primary' onclick='listar_usuario(1, $qnt_result_pg)'>Primeira</button> ";

    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            echo "<a onclick='listar_usuario($pag_ant, $qnt_result_pg)'>$pag_ant </a> ";
        }
    }

    echo " $pagina ";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            echo " <a onclick='listar_usuario($pag_dep, $qnt_result_pg)'>$pag_dep</a> ";
        }
    }

    echo "<button class='btn btn-primary' onclick='listar_usuario($quantidade_pg, $qnt_result_pg)'>Última</button>";
} else {
    echo "<div class='alert alert-danger' role='alert'><strong>Nenhuma marcação encontrada, por favor recarregue a pagina!!!</strong></div>";
}
?>