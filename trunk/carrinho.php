<?php 

$_GET["page"] = "Carrinho";
require_once "header.php";
echo "teste = ";
require_once "ruda.php";

	$carrinho = Carrinho::getCarrinho();
	var_dump($carrinho);
	echo "teste = ".$carrinho;
	/* foreach($carrinho as $produto):
		echo $produto->nome;
	endforeach; */
?>

<a href="finalizarCompra.php"><input type="button" id="botaoFinalizarCompra" value="Finalizar Compra"/></a>

<?php 

require_once "footer.php";

?>