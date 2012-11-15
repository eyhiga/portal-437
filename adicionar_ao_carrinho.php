<?php
	require_once("ruda.php");
	$prodID = $_GET["prodID"];
	
	$produto = Produto::getProdutoByCodigo($prodID);
	
	Carrinho::insertProduct($produto);
	
	$redirect = "./carrinho.php";
	header("location:$redirect");
?>