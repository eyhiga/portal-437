<?php 

$_GET["page"] = "Finalizar Compra";
require_once "header.php";
require_once "lib/nusoap.php";
require_once "links.php";
ini_set('display_errors', 1);
ini_set('allow_url_fopen', 1);
error_reporting(E_ALL);

/* 2º passo - Escolha de frete */
if(isset($_POST["confirmarEndereco"])){
	
	$_SESSION["enderecoEntrega"] = $enderecoEntrega = $_POST["endereco"];
	$_SESSION["cepEntrega"] = $cepEntrega = $_POST["cep"];
	$_SESSION["estadoEntrega"] = $estadoEntrega = $_POST["estado"];
	$_SESSION["cidadeEntrega"] = $cidadeEntrega = $_POST["cidade"];
	$_SESSION["bairroEntrega"] = $bairroEntrega = $_POST["bairro"];
	$_SESSION["tipoEntrega"] = $tipoEntrega = $_POST["tipo"];
	$_SESSION["numeroEntrega"] = $numeroEntrega = $_POST["numero"];

	// Busca a lista de transportadoras existentes
	/* $client = new nusoap_client($comp09, true);
	$params = array("");
	$result = $client->call("UC003", $params); */
	
	// Busca o valor do frete e prazo de entrega de cada tipo de transportadora
	$produtos = array(
			         "1" => array(
                           	"id_produto" => "10", 
                            "quantidade" => "1",
                            "peso" => "1.9",
                            "volume" => "2.3"
			         		)
                      );
	
	$frete = array();
	
	// Transporte 1
	$client = new nusoap_client($comp09, true);
	$params = array("cep_remetente" => $cepRemetente, "cep_destinatario" => $cepEntrega, "id_transportadora" => 1, "produtos" => $produtos);
	$freteService = $client->call("calculaFreteEPrazo", $params);
	$frete[0]["valor"] = $freteService["frete"];
	$frete[0]["prazo"] = $freteService["prazo"];

	// Transporte 2
	$params = array("cep_remetente" => $cepRemetente, "cep_destinatario" => $cepEntrega, "id_transportadora" => 2, "produtos" => $produtos);
	$freteService = $client->call("calculaFreteEPrazo", $params);
	$frete[1]["valor"] = $freteService["frete"];
	$frete[1]["prazo"] = $freteService["prazo"];
	
	// Transporte 3
	$params = array("cep_remetente" => $cepRemetente, "cep_destinatario" => $cepEntrega, "id_transportadora" => 3, "produtos" => $produtos);
	$freteService = $client->call("calculaFreteEPrazo", $params);
	$frete[2]["valor"] = $freteService["frete"];
	$frete[2]["prazo"] = $freteService["prazo"];
	
	// Transporte 4
	$params = array("cep_remetente" => $cepRemetente, "cep_destinatario" => $cepEntrega, "id_transportadora" => 4, "produtos" => $produtos);
	$freteService = $client->call("calculaFreteEPrazo", $params);
	$frete[3]["valor"] = $freteService["frete"];
	$frete[3]["prazo"] = $freteService["prazo"];

	$result = array();
	$result[0]["nome"] = "Sedex";
	$result[0]["id"] = 1;
	$result[1]["nome"] = "eSedex";
	$result[1]["id"] = 2;
	$result[2]["nome"] = "Pac";
	$result[2]["id"] = 3;
	$result[3]["nome"] = "Fedex";
	$result[3]["id"] = 4;

	?>
	<b>Escolha o seu frete:</b>
	<form name="formEscolhaFrete" action="" method="post">
		<?php
		foreach ($result as $key => $transportadora) {
			?><input type="radio" name="tipoFrete" id="tipoFrete" value="<?php echo $transportadora["id"]?>" checked /><?php echo $transportadora["nome"] ?> -- Valor: R$<?php echo number_format($frete[$key]["valor"], 2, ',', ''); ?> -- Prazo de entrega: <?php echo $frete[$key]["prazo"] ?> dias <br/>
			<input type="hidden" name="valorFrete" value="<?php echo $frete[$key]["valor"] ?>" />
			<input type="hidden" name="prazoFrete" value="<?php echo $frete[$key]["prazo"] ?>" /> 	
			<input type="hidden" name="nomeFrete" value="<?php echo $transportadora["nome"] ?>" />
		<?php } ?>
	
		<input type="submit" name="confirmarFrete" id="confirmarFrete" value="Próximo Passo" />
	
	</form>
	<?php 	
	
/* 3º passo - Escolha de meio de pagamento */
} elseif (isset($_POST["confirmarFrete"])) {
	/* Boleto - Grupo 03: http://mc437-2012s2-banco-ws.pagodabox.com/ws/BancoApi / Cartão de Crédito - Grupo 07: http://www.chainreactor.net/services/nusoap/WebServer.php */
	$_SESSION["tipoFrete"] = $_POST["tipoFrete"];
	$_SESSION["valorFrete"] = $_POST["valorFrete"];
	$_SESSION["prazoFrete"] = $_POST["prazoFrete"];
	$_SESSION["nomeFrete"] = $_POST["nomeFrete"];
	
	// Linha apenas para teste
	$_SESSION["valorCarrinho"] = 20000;
	
	$_SESSION["valorTotal"] = $_SESSION["valorCarrinho"] + $_SESSION["valorFrete"];
	
	$cartao = TRUE;
	if($usuario->score == "A" && $_SESSION["valorTotal"] > 30000) $cartao = FALSE;
	if($usuario->score == "B" && $_SESSION["valorTotal"] > 15000) $cartao = FALSE;
	if($usuario->score == "C" && $_SESSION["valorTotal"] > 10000) $cartao = FALSE;
	if($usuario->score == "D" && $_SESSION["valorTotal"] > 5000) $cartao = FALSE;
	if($usuario->score == "X") $cartao = FALSE;
	
	
	?>
	<b>Escolha o meio de pagamento:</b>
	<form name="formPagamento" action="" method="post">
		<?php if($cartao) { ?><input type="radio" name="pagamento" value="1" checked /> Cartão de Crédito<br/><?php } ?>
		<input type="radio" name="pagamento" value="2" /> Boleto Bancário<br/><br/>
		
		<input type="submit" name="confirmarPagamento" id="confirmarPagamento" value="Próximo Passo" />
	</form>
	<?php
	
/* 4º passo - Verificar parcelamento, validade do cartao / emitir boleto bancario */
} elseif (isset($_POST["confirmarPagamento"])){
	$meioPagamento = $_SESSION["meioPagamento"] = $_POST["pagamento"];
	
	// Cartão de Crédito
	if ($meioPagamento == 1) {
		// Escolher bandeira
		$client = new nusoap_client($comp07, true);
		$params = array("token" => 6);
		$pagamentos = $client->call("getPaymentBrands", $params);
		$teste = explode('"', $pagamentos);
		$pagamentos = array();
		$pagamentos[0]["brand"] = $teste[1];
		$pagamentos[0]["nome"] = $teste[3];
		$pagamentos[1]["brand"] = $teste[5];
		$pagamentos[1]["nome"] = $teste[7];
		$pagamentos[2]["brand"] = $teste[9];
		$pagamentos[2]["nome"] = $teste[11];
		$pagamentos[3]["brand"] = $teste[13];
		$pagamentos[3]["nome"] = $teste[15];
		
		?>
		
		<b>Escolha a bandeira do cartão:</b><br/>
		<form name="formConfPagamento" action="" method="post" >
			<select name="bandeira" id="bandeira" >
				<?php foreach ($pagamentos as $pagamento) { ?>
					<option value="<?php echo $pagamento["brand"] ?>"><?php echo $pagamento["nome"] ?></option>
				<?php } ?>
			</select>
		
			<?php 
			// Escolher parcelamento
			?>
			<div id="parcelamentos"></div>
		
		</form>
		<?php 
		
	// Boleto Bancário
	} else {
		// Emitir boleto bancário
		$client = new nusoap_client($comp03, true);
		$params = array("cnpj_contrato_convenio" => $cnpj, "token" => $token, "cliente" => $usuario->nome, "valor" => $_SESSION["valorTotal"]);
		$boleto = $client->call("emitir_boleto", $params);
		?>
		<b>Seu Boleto:</b><br/>
		<br/>Id: <?php echo $boleto["id"]; ?>
		<br/>Valor: R$<?php echo $boleto["valor"]; ?>
		<br/>Vencimento: R$<?php echo $boleto["data_vencimento"]; ?>
		<br/>Data de Criação: R$<?php echo $boleto["data_criacao"]; ?>
		<form action="" method="post">
			<input type="submit" name="terminoPagamento" id="terminoPagamento" value="Finalizar" /
		</form>
		<?php 
		$_SESSION["id_boleto"] = $boleto["id"];
	}


/* 5º passo - Efetuar Transação do cartão/boleto, e Verificar se cliente é bom pagador, se tem produto no estoque, dar baixa no estoque e cadastrar entrega */	
} elseif (isset($_POST["terminoPagamento"])) {
	
	if(isset($_POST["numeroCartao"])){
		$numeroCartao = $_POST["numeroCartao"];
		$nomeTitular = $_POST["nomeTitular"];
		$cpfTitular = $_POST["cpfTitular"];
		$codigoSeguranca = $_POST["codigoSeguranca"];
		$dataValidade = $_POST["dataValidade"];
		$bandeira = $_POST["bandeira"];
		$parcelamento = $_POST["parcelamento"];
		$parcelas = explode("|", $parcelamento);
		
		$client = new nusoap_client($comp07, true);
		$params = array("token" => 6, 
				"value" => $_SESSION["valorTotal"],
				"brand" => $bandeira,
				"number" => $numeroCartao,
				"name" => $nomeTitular,
				"cpf" => $cpfTitular,
				"code" => $codigoSeguranca,
				"date" => $dataValidade,
				"installments" => $parcelas[0],
				);
		$result = json_decode($client->call("doTransaction", $params));
		
		// Houve falha no pagamento
		if($result->success == 1) {
			echo "Sua compra foi realizada com sucesso";
			$transaction_id = $result->transaction_id;
		// Deu tudo certo no pagamento
		} else {
			echo "Você não pode efetuar esta compra por razões de crédito";
		}
	}
	
	// Cadastro de entrega
	$link09 = $comp09;
	$params09 = array("id_portal" => "06",
			"cep_destinatario" => $_SESSION["cepEntrega"],
			"cep_remetente" => $cepRemetente,
			"id_transportadora" => $_SESSION["tipoFrete"],
			"produtos" => array(
					"01" => array(
							"id_produto" => "10",
							"quantidade" => "1",
							"peso" => "1",
							"volume" => "1")
			)
	);
	
	$client9 = new nusoap_client($link09);
	$client9_resp = $client9->call("cadastrarEntrega", $params09);
	$_SESSION["id_entrega_cadastrada"] = $client9_resp;
	

	// Baixa no estoque
	$link08Upd = $comp08Upd;
	$attr08Upd = array("code" => "1010",
			"quantity" => "28");
	$attr08UpdJSON = json_encode($attr08Upd);
	$response = \Httpful\Request::put($link08Upd)
	->sendsJson()
	->body($js)
	->send();

	// Verificar se tem produto no estoque
    /* $link8Qtd = $comp08Qtd."10".".json";
    $ret8Qtd = file_get_contents($link8Qtd);
    $qts8 = json_decode($ret8);
    //echo $qts8->product->quantity; */
	
   
/* 1º passo - Escolha de endereço de entrega */
} else {
?>
<b>Endereço de entrega:</b><br/>
<form name="enderecoEntregaForm" action="" method="post">
	CEP:<input type="text" id="cep" value="<?php echo $usuario->cep ?>" disabled> <br/>
	<input type="hidden" id="cepH" name="cep" value="<?php echo $usuario->cep ?>">
	
	Estado:<input type="text" id="estado" value="<?php echo $usuario->estado ?>" disabled> <br/>
	<input type="hidden" name="estado" id="estadoH" value="<?php echo $usuario->estado ?>">
	
	Cidade:<input type="text" id="cidade" value="<?php echo $usuario->cidade ?>" disabled> <br/>
	<input type="hidden" name="cidade" id="cidadeH" value="<?php echo $usuario->cidade ?>">
	
	Bairro:<input type="text" id="bairro" value="<?php echo $usuario->bairro ?>" disabled> <br/>
	<input type="hidden" name="bairro" id="bairroH" value="<?php echo $usuario->bairro ?>">
	
	Tipo:<input type="text" id="tipo" value="<?php echo $usuario->tipo ?>" disabled> <br/>
	<input type="hidden" name="tipo" id="tipoH" value="<?php echo $usuario->tipo ?>">
	
	Endereço:<input type="text" id="endereco" value="<?php echo $usuario->endereco ?>" disabled> <br/>
	<input type="hidden" name="endereco" id="enderecoH" value="<?php echo $usuario->endereco ?>">
	
	Número:<input type="text" id="numero" value="<?php echo $usuario->numero ?>" disabled> <br/>
	<input type="hidden" name="numero" id="numeroH" value="<?php echo $usuario->numero ?>">
	
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
	var cep = $("#cep").val();
	$.post("ajax/buscaEnderecoCep.php", 
    {
		cep: cep
    },
    function (data) {
		// Retorno
        if(data.cepBuscado == true) {
            $("#estado").val(data.estado);
            $("#cidade").val(data.cidade);
            $("#bairro").val(data.bairro);
            $("#tipo").val(data.tipo);
            $("#endereco").val(data.endereco);

            $("#estadoH").val(data.estado);
            $("#cidadeH").val(data.cidade);
            $("#bairroH").val(data.bairro);
            $("#tipoH").val(data.tipo);
            $("#enderecoH").val(data.endereco);
            
        	$("#confirmarEndereco").removeAttr("disabled");    
        } else {
        	alert("O CEP não foi encontrado! Corrija e tente novamente");    
        }
    },
    "json"
    );
}

$("#bandeira").click(function(){
	var bandeira = $("#bandeira").val();
	$.post("ajax/buscaParcelamento.php", 
    {
		bandeira: bandeira
	},
    function (data) {
		// Retorno
        if(data.parcelamento == true) {
            //alert(data.retorno);
            var html = data.retorno;
            html += "<br/>Número do cartão de crédito: ";
            html += "<input type='text' name='numeroCartao' id='numeroCartao' onkeypress='mascaraInteiro()' maxlength='16' /><br/>";
            html += "Nome do titular: ";
            html += "<input type='text' name='nomeTitular' id='nomeTitular' /><br/>";
            html += "CPF do titular: ";
            html += "<input type='text' name='cpfTitular' id='cpfTitular' onkeypress='mascaraInteiro()' maxlength='11' /><br/>";
            html += "Código de Segurança: ";
            html += "<input type='text' name='codigoSeguranca' id='codigoSeguranca' onkeypress='mascaraInteiro()' maxlength='3' /><br/>";
            html += "Data de Validade: ";
            html += "<input type='text' name='dataValidade' id='dataValidade' onkeypress='mascaraInteiro()' maxlength='6' /><br/>";
            html += '<input type="submit" name="terminoPagamento" id="terminoPagamento" value="Finalizar" />';
            
            $("#parcelamentos").html(html);   
        } else {
        	alert("Houve um erro. Por favor, tente novamente");    
        }
    },
    "json"
    );
});

</script>
