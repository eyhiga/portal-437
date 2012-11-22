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
	
	$client_preco = file_get_contents($comp08Preco.$idProduto.".json");
    $preco = json_decode($client_preco);
                        
    $client_disp = file_get_contents($comp08Qtd.$idProduto.".json");
    $disp = json_decode($client_disp);
	
?>
<div style="float:left">
	<div style="float:left;width:40%">
		<br/><b>Nome:</b> <?php echo utf8_encode($descricao["return"]["nome"]) ?>
		<br/><b>Categoria:</b> <?php echo utf8_encode($descricao["return"]["categoria"]) ?>
		<br/><b>Descrição:</b> <?php echo utf8_encode($descricao["return"]["descricao"]) ?>
		<br/><b>Comprimento:</b> <?php echo $descricao["return"]["comprimento"] ?>
		<br/><b>Altura:</b> <?php echo $descricao["return"]["altura"] ?>
		<br/><b>Fabricante:</b> <?php echo utf8_encode($descricao["return"]["fabricante"]) ?>
		<br/><b>Peso:</b> <?php echo $descricao["return"]["peso"] ?>
		<br/><b>Largura:</b> <?php echo $descricao["return"]["largura"] ?>
		<br/><b>Preço:</b> R$<?php echo number_format($preco->product->price, 2, ',', '') ?>
		<br/><b>Qtde Estoque:</b> <?php echo $disp->product->quantity ?>
	</div>
	<?php 
	$volume = $descricao["return"]["altura"] * $descricao["return"]["largura"] * $descricao["return"]["comprimento"];
	?>
	<img id="imagem" src="<?php echo $descricao["return"]["imagem"] ?>" />
	<form action="adicionar_ao_carrinho.php" method="post">
		<input type="hidden" name="nome" value="<?php echo utf8_encode($descricao["return"]["nome"]) ?>" />
		<input type="hidden" name="id" value="<?php echo $idProduto ?>" />
		<input type="hidden" name="preco" value="<?php echo $preco->product->price ?>" />
		<input type="hidden" name="peso" value="<?php echo $descricao["return"]["peso"] ?>" />
		<input type="hidden" name="volume" value="<?php echo $volume ?>" />
		<input type="submit" id="btnAddCarrinho" value="Adicionar ao carrinho" />
	</form>
	
</div>	


<?php 

require_once "footer.php";

?>