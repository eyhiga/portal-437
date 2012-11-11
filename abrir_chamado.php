<?php
$_GET["page"] = "Abrir chamado";
require_once "header.php";
require_once "lib/nusoap.php"

?>

<form name="formCriarTicket" action="" method="post">
    <!--CPF: <input type="text" name="cpf" maxlength="15" /> <br/>-->
    <!--Grupo: <input type="text" name="grupo" maxlength="5" /> <br/>-->
    Tipo de Chamado: 
    <select name="tipoChamado">
        <option value="1">Sugestao</option>
        <option value="2">Duvida</option>
        <option value="3">Reclamacao</option>
        <option value="4">Pedido</option>
    </select>
    <br/>
    <br/>
    Texto: <textarea name="texto"></textarea> <br/>
    <br>
        
    <input type="submit" name="criarTicket" value="Enviar" />
</form>

<?php

if(isset($_POST["criarTicket"])) {
    $cpf = $_POST["cpf"];
    $grupo = "06";
    $texto = $_POST["texto"];
    $tipoChamado = $_POST["tipoChamado"];

    //$client = new nusoap_client("http://localhost/servico-atendimento-cliente/trunk/CriarTicketServico.php");
    $client = new nusoap_client("http://mpsolucoesweb.com.br/atendimento-cliente/CriarTicketServico.php");

    $error = $client->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }

    $result = $client->call("CriarTicket", array("CPF" => $cpf, "Texto" => $texto, "TipoChamado" => $tipoChamado, "Grupo" => $grupo));

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
            if(!$result["Erro"])
            {
                echo "Cóo de acompanhamento: ".$result["CodigoAcompanhamento"];
            }
            // Se houve erro, mostro o codigo do erro
            else
            {
                echo "Erro: ".$result["Erro"];
            }
        }
    }


}

require_once "footer.php";
?>
