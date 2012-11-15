<?php 

$_GET["page"] = "Finalizar Compra";
require_once "header.php";
require_once "lib/nusoap.php";
require_once "links.php";

?>

Finalizar Compra.<br/>
Fluxo:<br/>
Daniel - Escolher endereço de entrega (Grupo 09 - Buscar lista de transportadoras; Calcular prazo de entrega e frete): http://staff01.lab.ic.unicamp.br/grupo9/test/index.php (Necessário fazer tunelamento SSH)<br/>
Daniel - Escolher frete (Grupo 09): <a href="https://docs.google.com/document/pub?id=15Jd78GReI15YBYTKFis_SmIoLfseL1lFrLiZxTkxt5U">Documentação</a><br/>
Daniel - Escolher meio de pagamento (Boleto - Grupo 03: http://mc437-2012s2-banco-ws.pagodabox.com/ws/BancoApi / Cartão de Crédito - Grupo 07: http://www.chainreactor.net/services/nusoap/WebServer.php);<br/>
Eduardo - Verificar se cliente é bom pagador (Grupo 04);<br/>

<?php
    $args4 = array("cpf" => "39764194869",
                   "token" => "0123456789");
    
    $client4 = new nusoap_client($comp04, true);
    $score = $client4->call("getScore", $args4);
    print_r($score);
?>

Eduardo - Verificar se tem produto no estoque (Grupo 08);<br/>

<?php
    $link8 = $comp08."10".".json";
    $ret8 = file_get_contents($link8);
    echo $link8;
    echo $ret8;
    //$qts8 = json_decode($ret8);
    //print_r($qts8);
?>

Eduardo - Dar baixa no estoque (Grupo 08) e cadastrar entrega (Grupo 09).<br/><br/><br/>

<?php 

require_once "footer.php";

?>
