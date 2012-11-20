<?php 
class Produto
{
	public $codigo;
	public $nome;
	public $categoria;
	public $fabricante;
	public $descricao;
	public $imagem;
	public $comprimento;
	public $largura;
	public $altura;
	public $peso;
	
	function __construct() {
       
	}
	
	static function getClient() 
	{
		$client = null;
		try
		{
			//$client = new SoapClient ("http://staff01.lab.ic.unicamp.br:8080/ProdUNICAMPServices/services/Servicos?wsdl");
		}catch(Exception $e)
		{ 
            echo "<h2>Exception Error!</h2>"; 
            echo $e->getMessage(); 
			
        } 
		
		return $client;
	}

	public static function getProdutoByCodigo($codigo){
		$produto = new Produto();
		$produto->nome = "produto 1";;
		$produto->imagem = "http://4.bp.blogspot.com/_QNUjRg81CRM/S60suTp_4KI/AAAAAAAACeM/aTAkIQnr9JU/s1600/Debora-secco-nua-2.jpg";
		$produto->codigo = $codigo;
		$produto->descricao = "lalaoeraioa aihe ajken kajnlak jsdn lkajsdn klajsndkl ajsnd kajnsdkl ajnsd kajsn dlkajnsdkjan sdlknas kldjanlskdna skdna ksjdna d";
		return $produto;
	}
	
    public static function getCategories()
    {
		//$soap = Produto::getClient();
	  //return $soap->GetListCategoria();
	  return array(12 => "eletrodomesticos", 32 => "eletronicos");
    }
	
	public static function getListProdutoByFilter($nome,$categoria,$fabricante,$pesoMin,$pesoMax)
	{
		$produtos = array();	
		
		for($i = 0;$i < 10;$i++)
		{
			$produto = new Produto();
			$produto->nome = "produto$i";
			$produto->imagem = "http://4.bp.blogspot.com/_QNUjRg81CRM/S60suTp_4KI/AAAAAAAACeM/aTAkIQnr9JU/s1600/Debora-secco-nua-2.jpg";
			//$produto->preco = $i * 4 - 1;
			$produto->codigo = $i; 
			array_push($produtos,$produto);
		}
		
		return $produtos;
	}
}

class Carrinho
{
	public static $index = "carrinho";
	
	public static function getCarrinho()
	{
		if(!isset($_SESSION)){ 
			session_start();
		}
		if(!isset($_SESSION[self::$index]))
		{
			$_SESSION[self::$index] = array();
		}
		
		return $_SESSION[self::$index];
	}
	
	public static function insertProduct($produto){
		session_start();
		if(!isset($_SESSION[self::$index]))
		{
			$_SESSION[self::$index] = array();
		}
		array_push($_SESSION[self::$index],$produto);
		
	}
	
	public static function count()
	{
			return count(Carrinho::getCarrinho());
	}
}
?>