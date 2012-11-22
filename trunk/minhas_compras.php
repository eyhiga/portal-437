<?php 
require_once "ruda.php";
$_GET["page"] = "Minhas compras";
require_once "header.php";
require_once "links.php";
require_once "lib/nusoap.php";

$id_compra = $_SESSION["id_entrega_cadastrada"];
$id_compra = 320;

$compra_client = new nusoap_client($comp09, true);

$params = array("id_entrega" => $id_compra);
$compraService = $compra_client->call("consultarEntrega", $params);

$id_boleto = $_SESSION["id_boleto"];
//$id_boleto = 381;

$boleto_client = new nusoap_client($comp03, true);
$params = array("cnpj_contrato_convenio" => $cnpj, 
                "token" => $token, 
                "id" => $id_boleto);
$boleto_response = $boleto_client->call("obter_boleto", $params);

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

<br/><br/><br/>

<table>
    <tr>
        <td>
            Boleto
        </td>
        <td>
            Status
        </td>
        <td>
            Data vencimento
        </td>
    </tr>
    <tr>
        <td><?php echo $boleto_response["id"];?></td>
        <td>
            <?php 
                $status = "";
                switch($boleto_response["estado"])
                {
                    case "0":
                        $status = "Cancelado";
                        break;
                    case "1":
                        $status = "Compensado";
                        break;
                    case "2":
                        $status = "Gerado";
                        break;
                    case "3":
                        $status = "Pago";
                        break;
                    case "4":
                        $status = "Retificado";
                        break;
                }
                echo $status;
            ?>
        </td>
        <td><?php echo $boleto_response["data_vencimento"];?></td>
    </tr>
</table>
<?php 

require_once "footer.php";

?>
