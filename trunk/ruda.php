<?php 

class Produto
{
	public $nome;
	public $preco;
	public $urlImage;
	public $id;
	
	function __construct() {
       
   }
}

function listar_produtos($produtos) 
{ 
	  foreach($produtos as $produto)
	{
?>
    <p><a href="produtos.php?prodID=<?php echo $produto->nome; ?>"><?php echo $produto->nome; ?></a></p>
<?php
    }
}
?>