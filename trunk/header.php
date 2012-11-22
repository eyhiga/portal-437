<?php

//Erros do PHP; Desabilitar quando subir pra producao
ini_set("display_errors", 1);
error_reporting(E_ERROR);

$cepRemetente = "30330240";

//Incluindo arquivos
date_default_timezone_set('America/Sao_Paulo');
require_once "inc/includes.php";
//Seta a session
UsefulMethods::sessionStart();

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = NULL;
}

// Nome da pagina. Pode ser utilizado para titulo dinamico e tags meta; Tambem eh utilizado para marcacao de login
if ($page != "Login") {
    $_SESSION["redirecionarPagina"] = UsefulMethods::curPageURL();
} 
if ((($page == "Carrinho") || ($page == "Minhas compras") || ($page == "Finalizar Compra") || ($page == "Atendimento")) && (!UsefulMethods::verificarLogin())) {
	$url = "login.php";
	UsefulMethods::redirectPage($url);
} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Language" content="pt-br" />
        <meta name="description" content="Portal de vendas Sindao" />
        <meta name="author" content="Grupo06" />
        <meta name="robots" content="index, follow, noodp" />
        <title>Portal De Vendas | <?php print $page; ?>
        </title>

        <!-- INCLUINDO CSS -->
        <link type="text/css" href="css/style.css" rel="stylesheet" />
        <link type="text/css" href="css/ruda.css" rel="stylesheet" />
        <link type="text/css" href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <!--[if IE 6]>
		<link rel="stylesheet" type="text/css" href="iecss.css" />
		<![endif]-->
        <!-- INCLUINDO JAVASCRIPTS -->
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/libraries.js"></script>
        <script type="text/javascript" src="js/boxOver.js"></script>
        <script type="text/javascript" src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
    </head>
    <body>
    	<?php 
    	$logado = FALSE;
    	// Usuario esta logado
        if (UsefulMethods::verificarLogin()){
            $usuario = unserialize($_SESSION["usuario"]);
            $logado = TRUE;
            PageViews::menuSuperior($usuario, $logado);
            PageViews::menuLateralEsquerda();
			// Usuario nao esta logado
        }

        if (!UsefulMethods::verificarLogin()){
        	PageViews::menuSuperior($usuario, $logado);
        	PageViews::menuLateralEsquerda();
        }
        
        ?>
        <div class="center_content">
