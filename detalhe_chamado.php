<?php

$_GET["page"] = "Detalhe chamado";
require_once "header.php";
require_once "lib/nusoap.php";

$usuario = unserialize($_SESSION["usuario"]);

$cpf = $usuario->cpf;
$grupo = "06";
$id = $_GET["cod"];
?>

<form name="formConsultarTicket" action="" method="post">
    Codigo de Acompanhamento: <?php echo $id;?> <br/>
</form>

<?php

    // Cria um cliente SOAP
    //$client = new nusoap_client("http://localhost/servico-atendimento-cliente/ConsultarTicketServico.php?wsdl", true);
    //$client = new nusoap_client("http://localhost/servico-atendimento-cliente/ConsultarTicketServico.php");
    $client = new nusoap_client("http://mpsolucoesweb.com.br/atendimento-cliente/ConsultarTicketServico.php");

    // Verifica se houve algum erro na conexao SOAP
    $error = $client->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }

    // Executa a chamada para a funcao desejada
    $result = $client->call("ConsultarTicket", array("CodigoAcompanhamento" => $id));

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
                echo "CPF: ".$result["CPF"];
                echo "<br/>Tipo de Chamado: ".$result["TipoChamado"];
                $conteudo = $result["Texto"];
                $conteudoQuebrado = explode("|", $conteudo);
                $data = $result["Data"];
                $dataQuebrada = explode("|", $data);
                $i = 0;
                foreach ($conteudoQuebrado as $resposta)
                {
                    echo "<br/>Data: ".$dataQuebrada[$i];
                    echo "&nbsp;Pergunta/Resposta: ".$resposta;
                    $i++;
                }
                echo "<br/><a href=\"responder_chamado.php?cod=".$id."\">Responder ticket</a>";
            }
            // Se houve erro, mostro o codigo do erro
            else
            {
                echo "Erro: ".$result["Erro"];
            }
        }
    }
?>


<?php

require_once "footer.php";

?>
