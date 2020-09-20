<?php 

    $data_escolhida = $_SESSION["data_escolhida"];

    $consulta = "SELECT * FROM horarios WHERE id = ".$data_escolhida->format('N');

    $result = mysqli_query($conexao, $consulta);

    $dia_semana = mysqli_fetch_array($result);

    $hora_inicio = $dia_semana["hora_inicio"];
    $hora_termino = $dia_semana["hora_termino"];


?>