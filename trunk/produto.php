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
	
?>
<div style="float:left">
	<div style="float:left;width:40%">
		<br/>Nome: <?php echo $descricao["return"]["nome"] ?>
		<br/>Categoria: <?php echo $descricao["return"]["categoria"] ?>
		<br/>Descrição: <?php echo $descricao["return"]["descricao"] ?>
		<br/>Comprimento: <?php echo $descricao["return"]["comprimento"] ?>
		<br/>Altura: <?php echo $descricao["return"]["altura"] ?>
		<br/>Fabricante: <?php echo $descricao["return"]["fabricante"] ?>
		<br/>Peso: <?php echo $descricao["return"]["peso"] ?>
		<br/>Largura: <?php echo $descricao["return"]["largura"] ?>
		<br/>Preço: <?php echo 0 ?>
		<br/>Qtde Estoque: <?php echo 0 ?>
	</div>
	
	<img id="imagem" src="<?php echo $descricao["return"]["imagem"] ?>" />
	
</div>	


<?php 

require_once "footer.php";

?>