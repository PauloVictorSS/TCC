<?php

    $sql = "SELECT * FROM `fotos` WHERE aprovado = 1 and statu = 1 ORDER BY RAND() LIMIT 0,8";

    $resultado = mysqli_query($conexao, $sql);

    while($result=mysqli_fetch_array($resultado)){
        echo '<div style="background-image: url(data:image/jpeg;base64,'.base64_encode( $result['tamanho'] ).');" class="banner-single" ></div>';
    }


?>