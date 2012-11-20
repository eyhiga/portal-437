<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once("../links.php");
include_once("../inc/UsefulMethods.class.php");
include_once("../lib/nusoap.php");

//Seta a session
UsefulMethods::sessionStart();

if (!(isset($_POST["cep"]))){
	echo "Parametros necessarios nao foram enviados";
	exit();
}

$cep = trim($_POST["cep"]);

$mensagem["cepBuscado"] = FALSE;

$client = new nusoap_client($comp02, true);
$params = array($cep);
$result = $client->call("g02_busca_por_cep", $params);

if ($result["erro"] == 0) {
	$mensagem["cepBuscado"] = TRUE;
	$mensagem["estado"] = utf8_encode($result["uf"]);
	$mensagem["cidade"] = utf8_encode($result["cidade"]);
	$mensagem["bairro"] = utf8_encode($result["bairro"]);
	$mensagem["tipo"] = utf8_encode($result["tipo"]);
	$mensagem["endereco"] = utf8_encode($result["logradouro"]);
}

header("Content-Type: application/json");
print json_encode($mensagem);
exit();