<?php

$_GET['page'] = 'Login';
require_once 'header.php';

/*
 * Formulario de login foi enviado
 */
if (isset($_POST['formLoginLogin']) && isset($_POST['formLoginSenha'])) {
	$login = $_POST['formLoginLogin'];
	$senha = $_POST['formLoginSenha'];
	
	/*
	 * Chamar servico de autenticacao para verificar se dados de login estao corretos
	 */
	
	// Se servico retornar que dados estao corretos, variavel eh setada para true
	$logado = TRUE;
	
	if ($logado) {
		/*
		 * Chamar servico de clientes para pegar todos os dados do cliente, e setar os atributos aqui antes de serializar na sessao
		 */
		$usuario->nome = "Teste Nome";
		$usuario->cep = "13083852";
		$usuario->estado = "SP";
		$usuario->cidade = "Campinas";
		$usuario->bairro = "Cidade Universitária";
		$usuario->tipo = "Avenida";
		$usuario->endereco = "Albert Einstein";
		$usuario->numero = "350";
		
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