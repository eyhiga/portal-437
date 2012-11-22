<?php include "ruda.php"?>
<link rel="stylesheet" type="text/css" href="css/ruda.css" />
<?php 
$_GET["page"] = "Listagem de Produtos da Categoria";
require_once "header.php";
?>

<?php 

$categ = $_GET["categID"];
//$produtos = Produto::getListProdutoByFilter("",$categ,"","","");

$client = new nusoap_client($comp05, true);
$params = array(
            "categoria" => utf8_decode($categ)
          );
$produtos = $client->call("getListProdutoByFilter", $params);

?>

<div id="produtos_container">
	<?php 
		foreach($produtos["return"] as $produto):
			?>
			<div class="pdt">
				<div class="pdt_in">
					<a href="produto.php?prodID=<?php echo $produto["codigo"]; ?>">
						<img src="<?php echo $produto["imagem"]; ?>" />
					</a>
					<div class="pdt_nome">Nome: <?php echo utf8_encode($produto["nome"]);?></div>
					<div><a href="adicionar_ao_carrinho.php?prodID=<?php echo $produto["codigo"]; ?>">adicionar ao carrinho</a></div>
					<!--<div class="pdt_preco">Preco R$: <?php //echo $produto->preco; ?></div>-->
				</div>
			</div>
	<?php
		endforeach;
	?>
</div>

<?php 
require_once "footer.php";
?>
