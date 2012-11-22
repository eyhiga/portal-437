<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once("../links.php");
include_once("../inc/UsefulMethods.class.php");
include_once("../lib/nusoap.php");

//Seta a session
UsefulMethods::sessionStart();

if (!(isset($_POST["bandeira"]))){
	echo "Parametros necessarios nao foram enviados";
	exit();
}

$usuario = unserialize($_SESSION["usuario"]);
$score = $usuario->score;

$bandeira = trim($_POST["bandeira"]);
$valorTotal = $_SESSION["valorTotal"];

$mensagem["parcelamento"] = FALSE;

$client = new nusoap_client($comp07, true);
$params = array("token" => 6, "value" => $valorTotal, "brand" => $bandeira);
$result = json_decode($client->call("getInstallments", $params));

$mensagem["retorno"] = "<select name='parcelamento' id='parcelamento'>";
foreach ($result as $dado) {
    if()
	$mensagem["retorno"] .= "<option value='".$dado->installments."|".$dado->value."'>".$dado->installments." x R$".$dado->value."</option>";
}
$mensagem["retorno"] .= "</select>";
$mensagem["parcelamento"] = TRUE;

header("Content-Type: application/json");
print json_encode($mensagem);
exit();
