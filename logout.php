<?php

    require_once "inc/UsefulMethods.class.php";
    UsefulMethods::cacheHeader();
    UsefulMethods::sessionStart();
    
    if(isset($_SESSION['usuario'])){
        session_destroy();
    }
            
    if ((isset($_SESSION["redirecionarPagina"]))){
        $url = $_SESSION["redirecionarPagina"];
        unset($_SESSION["redirecionarPagina"]);
    } else {
        $url = "index.php";
    }
    UsefulMethods::redirectPage($url);

?>