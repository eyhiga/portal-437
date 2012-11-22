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
                    <?php
                        $client_preco = file_get_contents($comp08Preco.$produto["codigo"].".json");
                        $preco = json_decode($client_preco);
                        
                        $client_disp = file_get_contents($comp08Qtd.$produto["codigo"].".json");
                        $disp = json_decode($client_disp);
                    ?>
                    <div>R$ <?php echo number_format($preco->product->price, 2, ',', '') ?></div>
                    <div>Disponiveis: <?php echo $disp->product->quantity;?> </div>
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
