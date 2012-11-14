<?php 

$_GET["page"] = "Carrinho de Compras";
require_once "header.php";

?>

Carrinho de Compras<br/>
RUDÁ: Aqui, mostrar uma lista com todos os itens do carrinho de compras do usuário, com respectiva quantidade de cada e valor, e também valor total.
Guardar dados na session<br/>

<a href="finalizarCompra.php"><input type="button" id="botaoFinalizarCompra" value="Finalizar Compra" /></a>

<?php 

require_once "footer.php";

?>