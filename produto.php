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
	
	var_dump($descricao);
	
?>
<div style="float:left">
	<div style="float:left;width:40%">
		<?php echo $produto->descricao; ?>
	</div>
	
	<img id="imagem" src="<?php echo $produto->imagem; ?>" />
	
</div>	


<?php 

require_once "footer.php";

?>