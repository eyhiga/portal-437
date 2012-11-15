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
	$produto = Produto::getProdutoByCodigo($_GET["prodID"]);
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