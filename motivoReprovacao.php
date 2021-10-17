<?php
session_start();
require 'init.php';
require 'check.php';

$userQueReprovou = $_SESSION['user_id'];
$dia  = date("d/m/Y");
$userQueTeveOPontoReprovado = $_POST['confirmar'];
$motivo = $_POST['motivo'];


motivoReprovacao($dia, $motivo, $userQueReprovou, $userQueTeveOPontoReprovado);