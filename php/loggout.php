<?php

    include "../config.php";
    include "../database/conexao_mysql.php";     

    unset($_SESSION["id_user"]);

    header("Location: ".INCLUDE_PATH."login");


?>