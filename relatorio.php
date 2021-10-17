<?php
session_start();
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
require 'init.php';
require 'check.php';
require_once __DIR__ . '/vendor/autoload.php';


if (time() >= $_SESSION['logout_time']) {
  header("location:logout.php"); //vai para logout
}

//VARIAVEIS DE SESSAO
$usuario = $_SESSION['user_name'];

$nome = $_SESSION['nome_completo'];

$tipo = $_SESSION['tipo'];

$abreviacao = $_SESSION['abreviacao'];

$nivel = $_SESSION['nivel'];

$img = $_SESSION['img'];

$id_user = $_SESSION['user_id'];

$mes = substr($_POST['mes'],0,1);
$id_consulta = substr($_POST['mes'],1,10);

$ponto  = retonaPontoPorIdFuncionarioMes($id_consulta,$mes);
$infoUser = retonaInfoFuncionarioPorId($id_consulta);

ob_start();
$mpdf = new \Mpdf\Mpdf();
$mpdf->Bookmark('Inicio do documento');
$mpdf->allow_charset_conversion = true;
$mpdf->charset_in = 'windows-1252';
$mpdf->SetTitle("Empresa Júnior");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');


$mpdf->WriteHTML('<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Relatorio</title>
    <link rel="stylesheet" href="stylePDF.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="img\logo\logoCEUB.png">
      </div>
      <div id="company">
        <h2 class="name">Empresa Júnior</h2>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client"> <h2>Relatório Ponto </h2>');

foreach ($infoUser as $value) {
  $mpdf->WriteHTML('
  <h2 class="name">' . $value->nome_completo . '</h2>
          <div class="email">
            <a href=' . $value->usuario . '>' . $value->usuario . '</a>
          </div>
        </div>');
}

$date = date("d/m/Y");


$mpdf->WriteHTML('<div id="invoice">
          <div class="name">Emitido por: ' . $nome . '</div>
          <div class="date">Data de emissão: ' . $date . '</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <tbody>');

foreach ($ponto as $marcacoes) {
  $dataMarcacao = new DateTime($marcacoes->dia);
  $mpdf->WriteHTML('
  <tr>
    <td class="desc">
      <h3>'.$dataMarcacao->format("d/m/Y").'</h3>' . substr($marcacoes->entrada, 11, 15) . ' - ' . substr($marcacoes->almoco, 11, 15) . ' - ' . substr($marcacoes->volta, 11, 15) . ' - ' . substr($marcacoes->saida, 11, 15). '
    </td>
  </tr>');
}



$mpdf->WriteHTML('
        </tbody>
      </table>
</main>
  </body>
</html>');
$mpdf->Output();
