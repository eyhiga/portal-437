<?php

$_GET['page'] = 'Login';
require_once 'header.php';
require_once 'links.php';
require_once 'lib/nusoap.php';

/*
 * Formulario de login foi enviado
 */
if (isset($_POST['formLoginLogin']) && isset($_POST['formLoginSenha'])) {
	$login = $_POST['formLoginLogin'];
	$senha = $_POST['formLoginSenha'];

    //41587613107
    //47145639203
    //47926964883
	
	/*
	 * Chamar servico de autenticacao para verificar se dados de login estao corretos
	 */
	
    $login_json = file_get_contents($comp10."?login=".$login."&senha=".$senha);     
    $loginResponse = json_decode($login_json);
    $logado = $loginResponse->response == "0";
	// Se servico retornar que dados estao corretos, variavel eh setada para true
	//$logado = TRUE;
	
	if ($logado) {
		/*
		 * Chamar servico de clientes para pegar todos os dados do cliente, e setar os atributos aqui antes de serializar na sessao
		 */
        //echo $comp01.$login.".json";  
        $clientes_info_json = file_get_contents($comp01.$login.".json");
        //print_r($clientes_info_json);
        $clientes_info = json_decode($clientes_info_json);
        //print_r($clientes_info);

        $usuario->cpf = $clientes_info->cpf;
        $usuario->nome = $clientes_info->nome;
        $usuario->cep = $clientes_info->cep;
        
        $clientes_cep_json = file_get_contents($comp01cep.$login.".json");
        $clientes_cep = json_decode($clientes_cep_json);    

        $usuario->numero = $clientes_cep->numero;
        
        $client = new nusoap_client($comp02, true);
        $params = array($clientes_info->cep);
        $result = $client->call("g02_busca_por_cep", $params);

        if ($result["erro"] == 0) {
            $usuario->estado = utf8_encode($result["uf"]);
            $usuario->cidade = utf8_encode($result["cidade"]);
            $usuario->bairro = utf8_encode($result["bairro"]);
            $usuario->tipo = utf8_encode($result["tipo"]);
            $usuario->endereco = utf8_encode($result["logradouro"]);
        }

        $args4 = array("cpf" => $clientes_info->cpf,
                        "token" => "0123456789");
        $client4 = new nusoap_client($comp04, true);
        $client4_resp = $client4->call("getScore", $args4);
        $score = $client4_resp["return"]["score"]; 
        $usuario->score = $score;
        //print_r($usuario);
            //$usuario->cpf = "";
            //$usuario->nome = "Teste Nome";
            //$usuario->cep = "13083852";
            //$usuario->estado = "SP";
            //$usuario->cidade = "Campinas";
            //$usuario->bairro = "Cidade Universitária";
            //$usuario->tipo = "Avenida";
            //$usuario->endereco = "Albert Einstein";
            //$usuario->numero = "350";


        $_SESSION["usuario"] = serialize($usuario);
        $url = $_SESSION["redirecionarPagina"];
    } else {
        $url = 'login.php?err=1';
    }
    UsefulMethods::redirectPage($url);
    /*
     * Monta o formulario de login
     */
} else {
    if (isset($_GET['err'])) {
        if ($_GET['err'] == 1) {
            ?> <span>Seu login e/ou senha estão incorretos</span> <?php
        }
    }
    ?>
        <form id="formLogin" method="post" action="login.php">
        Login: <input type="text" id="formLoginLogin" name="formLoginLogin" maxlength="100" /><br/>
        Senha: <input type="password" id="formLoginSenha" name="formLoginSenha" maxlength="30" />

        <input type="submit" value="Entrar" />
        </form>
        <?php } 

        require_once 'footer.php';

        ?>
