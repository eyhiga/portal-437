<?php 

$_GET["page"] = "Categorias";
require_once "header.php";

?>

<?php
    $categorias = array(1 => "Eletronicos", 2 => "Eletrodomesticos", 3 => "Informatica");
    
    foreach($categorias as $categoria)
    {
?>
    <p><a href="produtos_da_categoria.php?categID=<?php echo $categoria; ?>"><?php echo $categoria; ?></a></p>
<?php        
    }
?>

<?php 

require_once "footer.php";

?>
