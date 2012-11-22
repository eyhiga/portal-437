<?php

$_GET["page"] = "Responder chamado";
require_once "header.php";
require_once "lib/nusoap.php";

$usuario = unserialize($_SESSION["usuario"]);

$cpf = $usuario->cpf;
$grupo = "06";
$id = $_GET["cod"];
?>

<form name="formResponderTicket" action="" method="post">
    Código de Acompanhamento: <?php echo $id;?> <br/>
    Texto: <textarea name="texto"></textarea> <br/>

    <input type="submit" name="responderTicket" value="Responder" />
</form>

<?php
if(isset($_POST["responderTicket"])) {
    $texto = $_POST["texto"];

    //$client = new nusoap_client("http://localhost/servico-atendimento-cliente/trunk/ResponderTicketServico.php");
    $client = new nusoap_client("http://mpsolucoesweb.com.br/atendimento-cliente/ResponderTicketServico.php");

    $error = $client->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }

    $result = $client->call("ResponderTicket", array("CodigoAcompanhamento" => $id, "Texto" => $texto));

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
            if(!$result)
            {
                echo "A resposta foi inserida com sucesso!";
            }
            // Se houve erro, mostro o codigo do erro
            else
            {
                echo "Erro: ".$result;
            }
        }
    }

}

?>


<?php

require_once "footer.php";

?>
