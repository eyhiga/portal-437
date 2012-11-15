<?php 

$_GET["page"] = "Carrinho de Compras";
require_once "header.php";
require_once "ruda.php";

?>

<?php
	$carrinho = Carrinho::getCarrinho();
	foreach($carrinho as $produto):
		echo $produto->nome;
	endforeach;
?>

<a href="finalizarCompra.php"><input type="button" id="botaoFinalizarCompra" value="Finalizar Compra" /></a>

<?php 

require_once "footer.php";

?>