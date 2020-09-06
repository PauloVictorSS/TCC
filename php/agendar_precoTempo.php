<?php

        $servicos = $_POST['servicos'];
        $tempoTotal = 0;
        $precoTotal = 0;

        echo "<p><b>Serviços escolhidos:</b></p>";

        foreach ($servicos as $id) {    

            $query = "SELECT nome, tempo, preco FROM `servicos_prestados` WHERE id='$id'";

            $result = mysqli_query($conexao, $query);

            while ($infs = mysqli_fetch_array($result)) {
                
                $tempoTotal += $infs['tempo'];
                $precoTotal += $infs['preco'];

                echo "<p>".$infs['nome']."</p>";
            }

        }

        $horas = intdiv($tempoTotal, 60);
        $min = $tempoTotal % 60;

        if($horas != 0 and $min != 0)
            $tempoTotal = $horas." horas".$min." minutos";

        elseif($horas == 0 and $min != 0)
            $tempoTotal = $min." minutos";   

        else
            $tempoTotal = $horas." horas";

        echo "<p><b>Duração total estimado:</b> ".$tempoTotal."</p>";
        echo "<p><b>Preço total estimado:</b> ".$precoTotal." reais</p>";
?>