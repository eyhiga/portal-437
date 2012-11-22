<?php

$_GET["page"] = "Consultar chamado";
require_once "header.php";
require_once "lib/nusoap.php";

$usuario = unserialize($_SESSION["usuario"]);

$cpf = $usuario->cpf;
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
            echo "<table>";
            echo "  <tr><td>Codigo de acompanhamento<td><tr>";
            foreach ($codigosAcompanhamento as $codigoAcompanhamento) 
            {
                echo "<tr>";
                echo "  <td>";
                echo "      <a href=\"detalhe_chamado.php?cod=".$codigoAcompanhamento."\">".$codigoAcompanhamento."</a>";
                echo "  </td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        // Se houve erro, mostro o codigo do erro
        else
        {
            if($result["Erro"] == "503")
            {
                echo "Nao ha chamados abertos<br/>";
            }
            else
            {
                echo "Erro: ".$result["Erro"];
            }
        }
    }
}

?>


<?php

require_once "footer.php";

?>
