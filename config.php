<?php
    
    if(!isset($_SESSION)) 
        session_start(); 

    date_default_timezone_set('America/Sao_Paulo');

    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DB", "tcc");

    define("INCLUDE_PATH", "http://localhost/GitHub/Escola/TCC/");
    define("INCLUDE_PATH_PAINEL", "http://localhost/GitHub/Escola/TCC/painel/");

    include("php/functions.php");
?>