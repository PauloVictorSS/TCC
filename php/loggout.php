<?php

    include "../config.php";
    include "../database/conexao_mysql.php";     

    unset($_SESSION["id_user"], $_SESSION["id_func"]);

    header("Location: ".INCLUDE_PATH."pages/login.php");


?>