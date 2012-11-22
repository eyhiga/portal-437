<?php 

$_GET["page"] = "Home";
require_once "header.php";

$produtosServico = array();
foreach($_SESSION['carrinho_lista'] as $index => $item) {
	$novo = array();
	$novo["id_produto"] = $item["id"];
	$novo["quantidade"] = $item["quantidade"];
	$novo["peso"] = $item["peso"];
	$novo["volume"] = $item["volume"];
	array_push($produtosServico, $novo);
}
var_dump($produtosServico);

require_once "footer.php";

?>
