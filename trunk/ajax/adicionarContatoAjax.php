<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
include_once("../inc/UsefulMethods.class.php");
include_once("../inc/Constants.class.php");
include_once("../entity/ContatoEntity.class.php");
include_once("../dao/ContatoDao.class.php");
include_once("../dao/ConexaoDao.class.php");

//Seta a session
UsefulMethods::sessionStart();

if (!(isset($_POST["id_usuario_1"])) || !(isset($_POST["id_usuario_2"]))){
	echo "Parametros necessarios nao foram enviados";
	exit();
}

$id_usuario_1 = trim($_POST["id_usuario_1"]);
$id_usuario_2 = trim($_POST["id_usuario_2"]);

$mensagem["contatoAdicionado"] = FALSE;

$contatoEnt = new ContatoEntity();
$contatoEnt->id_usuario_1 = $id_usuario_1;
$contatoEnt->id_usuario_2 = $id_usuario_2;

$contatoDao = new ContatoDao();
$success = $contatoDao->adicionarContato($contatoEnt);

if ($success) {
	$mensagem["contatoAdicionado"] = TRUE;
}

header("Content-Type: application/json");
print json_encode($mensagem);
exit();