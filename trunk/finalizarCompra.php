<?php 

$_GET["page"] = "Finalizar Compra";
require_once "header.php";

?>

Finalizar Compra.<br/>
Fluxo:<br/>
Daniel - Escolher endereço de entrega (Grupo 09 - Buscar lista de transportadoras; Calcular prazo de entrega e frete): http://staff01.lab.ic.unicamp.br/grupo9/test/index.php (Necessário fazer tunelamento SSH)<br/>
Daniel - Escolher frete (Grupo 09): <a href="https://docs.google.com/document/pub?id=15Jd78GReI15YBYTKFis_SmIoLfseL1lFrLiZxTkxt5U">Documentação</a><br/>
Daniel - Escolher meio de pagamento (Boleto - Grupo 03: http://mc437-2012s2-banco-ws.pagodabox.com/ws/BancoApi / Cartão de Crédito - Grupo 07: http://www.chainreactor.net/services/nusoap/WebServer.php);<br/>
Eduardo - Verificar se cliente é bom pagador (Grupo 04);<br/>
Eduardo - Verificar se tem produto no estoque (Grupo 08);<br/>
Eduardo - Dar baixa no estoque (Grupo 08) e cadastrar entrega (Grupo 09).<br/><br/><br/>

<?php 

require_once "footer.php";

?>