<?php

$_GET["page"] = "Consultar chamado";
require_once "header.php";
require_once "lib/nusoap.php";

$cpf = $_POST["cpf"];
$grupo = "06";

// Cria um cliente SOAP
//$client = new nusoap_client("http://localhost/servico-atendimento-cliente/trunk/ConsultarTicketCPFServico.php");
$client = new nusoap_client("http://mpsolucoesweb.com.br/atendimento-cliente/ConsultarTicketCPFServico.php");

// Verifica se houve algum erro na conexao SOAP
$error = $client->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}

// Executa a chamada para a funcao desejada
$result = $client->call("ConsultarTicketCPF", array("CPF" => $cpf, "Grupo" => $grupo));

// Verifica se houve algum erro de retorno
if ($client->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $client->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>" . $error . "</pre>";
    }
    else {
        // Exibe o retorno dos dados
        if(!$result["Erro"])
        {
            $codigosAcompanhamento = $result["CodigoAcompanhamento"];
            $codigosAcompanhamento = explode("|", $codigosAcompanhamento);
            foreach ($codigosAcompanhamento as $codigoAcompanhamento) 
            {
                echo "<br/>Codigo: ".$codigoAcompanhamento;
            }
        }
        // Se houve erro, mostro o codigo do erro
        else
        {
            echo "Erro: ".$result["Erro"];
        }
    }
}

?>

Consultar chamado

<?php

require_once "footer.php";

?>
