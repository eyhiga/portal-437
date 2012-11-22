<?php 
require_once "ruda.php";
$_GET["page"] = "Minhas compras";
require_once "header.php";
require_once "links.php";
require_once "lib/nusoap.php";

$id_compra = $_SESSION["id_entrega_cadastrada"];
//$id_compra = 320;

$compra_client = new nusoap_client($comp09, true);

$params = array("id_entrega" => $id_compra);
$compraService = $compra_client->call("consultarEntrega", $params);

?>

<table>
    <tr>
        <td>Compra</td>
        <td>Status</td>
    </tr>
    <tr>
        <td>
            <?php echo $id_compra;?>
        </td>
        <td>
            <?php echo $compraService;?>
        </td>
    </tr>
</table>

<?php 

require_once "footer.php";

?>
