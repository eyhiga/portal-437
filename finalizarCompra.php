<?php 

$_GET["page"] = "Finalizar Compra";
require_once "header.php";
require_once "lib/nusoap.php";
require_once "links.php";
ini_set('display_errors', 1);
ini_set('allow_url_fopen', true);
error_reporting(E_ALL);
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
    $client4_resp = $client4->call("getScore", $args4);
    $score = $client4_resp["return"]["score"];
    echo "Score:".$score."<br/>";
    //print_r($score);
?>

Eduardo - Verificar se tem produto no estoque (Grupo 08);<br/>

<?php
    $link8Qtd = $comp08Qtd."10".".json";
    $ret8Qtd = file_get_contents($link8Qtd);
    $qts8 = json_decode($ret8);
    //echo $qts8->product->quantity;
    echo "<br/>";
?>

Eduardo - Dar baixa no estoque (Grupo 08)

<?php

    $link08Upd = $comp08Upd;
    $attr08Upd = array("code" => "10",
                       "quantity" => "28");
    $params08Upd = array("http" => array(
                                    "method" => "PUT",
                                    "header" => "Content-type: text/xml",
                                    "content" => $attr08Upd));
    
    $response08Upd = file_get_contents($link08Upd, false, $params08Upd);
    print_r($response08Upd);

?>
<br/>
cadastrar entrega (Grupo 09).<br/><br/><br/>

<?php

    $link09 = $comp09;    
    $params09 = array("id_portal" => "06",
                      "cep_destinatario" => "13083755",
                      "cep_remetente" => "13083755",
                      "id_transportadora" => "1",
                      "produtos" => array(
                                    "01" => array(
                                                "id_produto" => "10", 
                                                "quantidade" => "1",
                                                "peso" => "1",
                                                "volume" => "1")
                      )
   ); 

   $client9 = new nusoap_client($link09); 
   //$client9_resp = $client9->call("cadastrarEntrega", $params09); 
   //print_r($client9_resp);

?>

<?php 

require_once "footer.php";

?>
