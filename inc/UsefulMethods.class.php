<?php

    /** 
     * Metodos uteis
	 * @package UsefulMethods
     */
    class UsefulMethods{
        
         /**
         * Redireciona a pagina para um novo destino
         * @param   string  $url    URL para a qual a pagina sera redirecionada
         * @return  void
         * 
         * @author Daniel Machado Reis
         */
        public static function redirectPage($url){
            //header("Location: ".$url);
            ?>
            <script language="javascript">
                //history.go(-1);
                window.location.replace("<?php echo $url ?>");
            </script>
            <?php
            exit();
        }
        /**
         * Ajusta caracteres especiais
         * @param   string  $string     String a ser ajustada
         * @return  string              String com caracteres especiais ajustados
         * 
         * @author Andre Araujo
         */
        public static function RemoveCaracteresEspeciais($string){
            $retorno    = str_replace("\\", "", $string);
            $retorno    = str_replace("//", "", $retorno);
            return addslashes($retorno);
        }

        /**
         * Obtem o nome da pagina atual
         * @return  string  nome da pagina atual
         * 
         * @author Daniel Machado Reis
         */
        public static function curPageName(){
            return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);    
        }
       
        /**
         * Obtem a URL completa da pagina atual
         * @return  string  URL da pagina atual
         * 
         * @author Daniel Machado Reis
         */
        public static function curPageURL(){
            $pageURL = 'http';
            if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
                $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }
            return $pageURL;
        }
        
        /**
         * Cabeçalho padrao para arquivos de ajax
         * @return  void
         * 
         * @author Daniel Machado Reis
         */
        public static function cabecalhoPadraoAjax(){
            //ini_set("display_errors", 1);  
            //error_reporting(E_ALL);
            date_default_timezone_set('America/Sao_Paulo');
            require_once "../includes/includes.php";
            if(!isset($_SESSION))
                session_start();
        }

        /**
         * Criar sessao do usuario e redirecionamento da pagina
         * @param  object  entidade do tipo Usuario
         * 
         * @author Daniel Machado Reis
         */
        public static function criarSessionUsuario($usuarioEnt){
            // Verifico se o usuario nao esta bloqueado. Se estiver, nao crio a sessao para ele
            $_SESSION["usuario"] = serialize($usuarioEnt);
            if ((isset($_SESSION["redirecionarPagina"]))){
                $url = $_SESSION["redirecionarPagina"];
                unset($_SESSION["redirecionarPagina"]);
            } else {
                $url = "index.php";
            }
            UsefulMethods::redirectPage($url); 
        }

        
        /**
         * Retorna um texto limitado a x caracteres
         * @param  $var string
         * @param  $limite int
         * @return $string 
         * @author Daniel Machado Reis/Andre Silva Araujo
         */
        public static function limitarTamanho($var, $limite){
            // Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
            if (strlen($var) > $limite)
            {
                return substr($var, 0, strrpos(substr($var, 0, $limite), ' ')) . '..';
            }
            else
            {
                // Se não for maior que o limite, ele não adiciona nada.
                return substr_replace ($var, '', $limite);
            }
        }
        
        /**
         * Verifico se o usuario esta logado
           */
        public static function verificarLogin(){
            if ((!isset($_SESSION["usuario"]) || empty($_SESSION["usuario"]))){
                return FALSE;
            } else {
            	return TRUE;
            }      
        }
        
        /**
         * Forca o navegador a sempre atualizar o arquivo
         *
         * @author Daniel Machado Reis
         */
        public static function cacheHeader(){
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
            header("Pragma: no-cache");    
        }
		
		/**
         * Inicializa uma sessao caso nao estiver ativa
         *
         * @author Andre Silva
         */
        public static function sessionStart(){
            if(!isset($_SESSION)){ 
				session_start();
			}
        }

    }

?>