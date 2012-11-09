<?php 

class Produto
{
	public $nome;
	public $preco;
	public $url;
	public $id;
	
	function __construct() {
       
   }
}

function listar_produtos($produtos) 
{ 
	  foreach($produtos as $produto)
	{
?>
	<div class="pdt">
		<div class="pdt_in">
			<a href="produtos.php?prodID=<?php echo $produto->id; ?>">
				<img src="<?php echo $produto->url; ?>" />
			</a>
				<div class="pdt_nome">Nome: <?php echo $produto->nome?></div>
				<div class="pdt_preco">Preco R$: <?php echo $produto->preco ?></div>
			</div>
		</div>
<?php
    }
}
?>