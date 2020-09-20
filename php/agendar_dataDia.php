<?php 

    $data_escolhida = $_SESSION["data_escolhida"];

    echo "<br><p><b>Data escolhida: </b> ".$data_escolhida->format('d/m/Y')."</p>";
    echo "<p><b>Dia da semana: </b> ".diaSemanaPortugues($data_escolhida->format('l'))."</p>";

    $consulta = "SELECT * FROM horarios WHERE id = ".$data_escolhida->format('N');

    $result = mysqli_query($conexao, $consulta);

    $dia_semana = mysqli_fetch_array($result);

    $hora_inicio = $dia_semana["hora_inicio"];
    $hora_termino = $dia_semana["hora_termino"];

    echo "<p><b>Horário de funcionamento nesse dia:</b> $hora_inicio - $hora_termino</p>";

?>