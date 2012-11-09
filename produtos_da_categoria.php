<?php include("ruda.php");?>
<link rel="stylesheet" type="text/css" href="css/ruda.css" />
<?php 

$_GET["page"] = "Listagem de Produtos da Categoria";
require_once "header.php";

?>

<?php 

$prod = $_GET["prodID"];

$produtos = array();

for($i = 1;$i < 15;$i++)
{
	$produto = new Produto();
	$produto->nome = "produto1";
	$produto->url = "http://4.bp.blogspot.com/_QNUjRg81CRM/S60suTp_4KI/AAAAAAAACeM/aTAkIQnr9JU/s1600/Debora-secco-nua-2.jpg";
	array_push($produtos,$produto);
}
?>
<div id="produtos_container">
	<?php listar_produtos($produtos); ?>
</div>

<?php 

require_once "footer.php";

?>
