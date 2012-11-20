<?php 

$_GET["page"] = "Finalizar Compra";
require_once "header.php";
require_once "lib/nusoap.php";
require_once "links.php";
ini_set('display_errors', 1);
ini_set('allow_url_fopen', 1);
error_reporting(E_ALL);

if(isset($_POST["confirmarEndereco"])){
	/*
	 Daniel - Escolher frete (Grupo 09): <a href="https://docs.google.com/document/pub?id=15Jd78GReI15YBYTKFis_SmIoLfseL1lFrLiZxTkxt5U">Documentação</a><br/>
	Daniel - Escolher meio de pagamento (Boleto - Grupo 03: http://mc437-2012s2-banco-ws.pagodabox.com/ws/BancoApi / Cartão de Crédito - Grupo 07: http://www.chainreactor.net/services/nusoap/WebServer.php);<br/>
	Eduardo - Verificar se cliente é bom pagador (Grupo 04);<br/> */
	
	$args4 = array("cpf" => "39764194869",
			"token" => "0123456789");
	
	/* $client4 = new nusoap_client($comp04, true);
	 $client4_resp = $client4->call("getScore", $args4);
	$score = $client4_resp["return"]["score"]; */
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
	    $attr08Upd = array("code" => "1010",
	                       "quantity" => "28");
        $attr08UpdJSON = json_encode($attr08Upd);
        $response = \Httpful\Request::put($link08Upd)
                    ->sendsJson()
                    ->body($js)
                    ->send();
	
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
} else {
/*
Daniel - Escolher endereço de entrega (Grupo 09 - Buscar lista de transportadoras; Calcular prazo de entrega e frete): http://staff01.lab.ic.unicamp.br/grupo9/test/index.php (Necessário fazer tunelamento SSH)<br/>
*/
?>
Endereço de entrega:<br/>
<form name="enderecoEntregaForm" action="" method="post">
	CEP:<input type="text" name="cep" id="cep" value="<?php echo $usuario->cep ?>" disabled> <br/>
	Estado:<input type="text" name="estado" id="estado" value="<?php echo $usuario->estado ?>" disabled> <br/>
	Cidade:<input type="text" name="cidade" id="cidade" value="<?php echo $usuario->cidade ?>" disabled> <br/>
	Bairro:<input type="text" name="bairro" id="bairro" value="<?php echo $usuario->bairro ?>" disabled> <br/>
	Tipo:<input type="text" name="tipo" id="cidade" value="<?php echo $usuario->tipo ?>" disabled> <br/>
	Endereço:<input type="text" name="endereco" id="endereco" value="<?php echo $usuario->endereco ?>" disabled> <br/>
	Número:<input type="text" name="numero" id="numero" value="<?php echo $usuario->numero ?>" disabled> <br/>
	<input type="button" onclick="alterarEndereco()" id="botaoAlterarEndereco" value="Alterar Endereço de Entrega" />&nbsp;&nbsp;
	<input type="submit" name="confirmarEndereco" id="confirmarEndereco" value="Próximo Passo" />
</form>

<?php 

} 

require_once "footer.php";

?>

<script type="text/javascript">
function alterarEndereco(){
	$("#cep").removeAttr("disabled");
	$("#numero").removeAttr("disabled");
	$("#botaoAlterarEndereco").attr("value","Buscar CEP");
	$("#botaoAlterarEndereco").attr("onclick","buscarCep()");		
	$("#confirmarEndereco").attr("disabled","disabled");
}

// Faz uma chamada ajax para carrregar dados do novo endereço, e libera o botao de proximo passo
function buscarCep(){
	$("#confirmarEndereco").removeAttr("disabled");
	return;
	var cep = $("#cep").val();
	$.post("ajax/buscaEnderecoCep.php", 
    {
		cep: cep
    },
    function (data) {
		// Retorno
        if(data.cepBuscado == true) {
        	alert("Contado adicionado com sucesso!");    
        } else {
        	alert("Erro ao adicionar contato, ele pode já ter sido adicionado por você!");    
        }
    },
    "json"
    );
}

</script>
