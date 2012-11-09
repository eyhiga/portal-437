<?php include("ruda.php");?>
<?php 

$_GET["page"] = "Listagem de Produtos da Categoria";
require_once "header.php";

?>

<?php 

$prod = $_GET["prodID"];

$produtos = array();

$produto1 = new Produto();
$produto1->nome = "produto1";
array_push($produtos,$produto1);
   listar_produtos($produtos);
   
?>
<?php 

require_once "footer.php";

?>
