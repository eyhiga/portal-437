<?php 

$_GET["page"] = "Listagem de Produtos da Categoria";
require_once "header.php";

?>

<?php 

$prod = $_GET["prodID"];

$produtos = array(1 => "Produto 1", 2 => "Produto 2");

    foreach($produtos as $produto)
	{
?>
    <p><a href="produtos.php?prodID=<?php echo $produto; ?>"><?php echo $produto; ?></a></p>
<?php
    }
?>
<?php 

require_once "footer.php";

?>
