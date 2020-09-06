<?php

    $sql = "SELECT * FROM fotos";

    $resultado = mysqli_query($conexao, $sql);

    while($result=mysqli_fetch_array($resultado)){
        echo '<div style="background-image: url(data:image/jpeg;base64,'.base64_encode( $result['tamanho'] ).');" class="banner-single" ></div>';
    }


?>