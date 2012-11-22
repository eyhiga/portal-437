<?php

if(!session_start())
{
    session_start();
}
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once "links.php";
require_once "lib/nusoap.php";

if(isset($_POST['adicionar']))
{
    $prodID = $_POST["id"];
    $nome = $_POST["nome"];
    $preco = $_POST["preco"];
    $volume = $_POST["volume"];
    $peso = $_POST["peso"];

    $client_disp = file_get_contents($comp08Qtd.$prodID.".json");
    $disp = json_decode($client_disp);
    $qtd = $disp->product->quantity;

    if (!isset($_SESSION['carrinho_lista']) || count($_SESSION['carrinho_lista']) <= 0) {

        $_SESSION['carrinho_lista'][] = array(
                "id" => $prodID, 
                "nome" => $nome, 
                "qtd" => 1, 
                "preco" => $preco,
                "volume" => $volume,
                "peso" => $peso);

        $_SESSION['valorCarrinho'] = $preco;
        $_SESSION['quantidadeProdutos'] = 1;
    }
    else {
        $achou = false;
        foreach($_SESSION['carrinho_lista'] as $index => $item) {
            if ($item['id'] == $prodID) {

                if($qtd > $item['qtd'])
                { 
                    $_SESSION['carrinho_lista'][$index] = array(
                            "id" => $item['id'], 
                            "nome" => $item['nome'],
                            "qtd" => $item['qtd']+1, 
                            "preco" => $item['preco'],
                            "volume" => $item['volume'],
                            "peso" => $item['peso']);
                    $_SESSION['valorCarrinho'] += $item['preco'];
                    $_SESSION['quantidadeProdutos'] += 1;
                }
                $achou = true;          
            }
        }

        if (!$achou) {

            $_SESSION['carrinho_lista'][] = array(
                    "id" => $prodID, 
                    "nome" => $nome,
                    "qtd" => 1, 
                    "preco" => $preco,
                    "volume" => $volume,
                    "peso" => $peso);
            $_SESSION['valorCarrinho'] += $preco;
            $_SESSION['quantidadeProdutos'] += 1;
        }
    }   
}
elseif(isset($_POST["remover"]))
{
    $prodID = $_POST["id"];

    foreach($_SESSION['carrinho_lista'] as $index => $item) {
        if ($item['id'] == $prodID) {
            $preco = $item["preco"];
            $qtd = $item["qtd"];
            $total = $preco * $qtd;
            $_SESSION['valorCarrinho'] -= $total;
            $_SESSION['quantidadeProdutos'] -= $qtd;
            unset($_SESSION['carrinho_lista'][$index]);
        }
    }
}
//var_dump($_SESSION['valorCarrinho']);
$redirect = "./carrinho.php";
header("location:$redirect");
?>
