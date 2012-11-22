<?php 
require_once "ruda.php";
$_GET["page"] = "Produto";
require_once "header.php";
?>

<style type="text/css">
	#imagem
	{
		width:50%;
		height:70%;
		float:right;
		padding:5px;
		border:solid 1px gray;
	}
</style>

<?php
	$idProduto = $_GET["prodID"];
	
	$client = new nusoap_client($comp05, true);
	$params = array("codigo" => $idProduto);
	$descricao = $client->call("getProdutoByCodigo", $params);
	
	/* $client = new nusoap_client($comp05, true);
	$params = array("codigo" => $idProduto);
	$estoque = $client->call("getProdutoByCodigo", $params); */
	
?>
<div style="float:left">
	<div style="float:left;width:40%">
		<br/><b>Nome:</b> <?php echo $descricao["return"]["nome"] ?>
		<br/><b>Categoria:</b> <?php echo $descricao["return"]["categoria"] ?>
		<br/><b>Descrição:</b> <?php echo $descricao["return"]["descricao"] ?>
		<br/><b>Comprimento:</b> <?php echo $descricao["return"]["comprimento"] ?>
		<br/><b>Altura:</b> <?php echo $descricao["return"]["altura"] ?>
		<br/><b>Fabricante:</b> <?php echo $descricao["return"]["fabricante"] ?>
		<br/><b>Peso:</b> <?php echo $descricao["return"]["peso"] ?>
		<br/><b>Largura:</b> <?php echo $descricao["return"]["largura"] ?>
		<br/><b>Preço:</b> <?php echo 0 ?>
		<br/><b>Qtde Estoque:</b> <?php echo 0 ?>
	</div>
	
	<img id="imagem" src="<?php echo $descricao["return"]["imagem"] ?>" />
	
</div>	


<?php 

require_once "footer.php";

?>