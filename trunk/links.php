<?php 
    // Clientes
    $comp01 = "http://mc437.herokuapp.com/tudo/";
    $comp01cep = "http://mc437.herokuapp.com/cep/";
	/* Busca de endereço por CEP */
	// https://docs.google.com/spreadsheet/ccc?key=0AnXiYPrlU4dtdGhKTXA3Z3NuOGlrWGt3dzM1TDIwWFE#gid=0
	// http://g2mc437.heliohost.org/parte2/service/teste-cep.php
	$comp02 = "http://g2mc437.heliohost.org/parte2/service/webserver.php/g02_busca_por_cep?wsdl";
	
	// Retorna a situacao de credito
    $comp04 = "http://staff01.lab.ic.unicamp.br:8480/ModuloValidacaoCreditoWS/services/ValidacaoCreditoService?wsdl";

    
    /* Cartão de Crédito */
    // http://www.chainreactor.net/services/help.pdf
    // https://docs.google.com/file/d/0B9Ddz98_HYxPaDJ4a3lBQmt0SDQ/edit
    // http://www.chainreactor.net/services/nusoap/WebClient.php
    // http://www.chainreactor.net/services/nusoap/WebServer.php
    $comp07 = "http://www.chainreactor.net/services/nusoap/WebServer.php?wsdl";
    
    // Verifica a quantidade de produtos no estoque
    $comp08Qtd = "http://g6:g6@mc437-g8-estoque-v2.webbyapp.com/products/currentQuantity/";
    
    // Altera quantidade de produtos no estoque
    $comp08Upd = "http://g6:g6@mc437-g8-estoque-v2.webbyapp.com/products/quantity/";
    
    // Escolha de Frete
    $comp09 = "http://staff01.lab.ic.unicamp.br/grupo9/webservice/ws.php?wsdl";

    // Login
    $comp10 = "http://staff03.lab.ic.unicamp.br:8888/authentications/loga.json";

?>
