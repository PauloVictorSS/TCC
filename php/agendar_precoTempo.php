<?php

        if(isset($_POST['servicos'])){
            $servicos = $_POST['servicos'];
            $_SESSION["servicosEscolhidos"] = array();
        }
        else
            $servicos = $_SESSION["servicosEscolhidos"]; 

        $tempoTotal = 0;
        $precoTotal = 0;

        echo "<p><b>Serviços escolhidos:</b></p>";

        foreach ($servicos as $key => $id) {    

            $_SESSION["servicosEscolhidos"][$key] = $id;

            $query = "SELECT nome, tempo, preco FROM `servicos_prestados` WHERE id='$id'";

            $result = mysqli_query($conexao, $query);

            while ($infs = mysqli_fetch_array($result)) {
                
                $tempoTotal += $infs['tempo'];
                $precoTotal += $infs['preco'];

                echo "<p>".$infs['nome']."</p>";
            }

        }

        $duracaoMinutos = $tempoTotal;

        $horas = intdiv($tempoTotal, 60);
        $min = $tempoTotal % 60;

        if($horas != 0 and $min != 0)
            $tempoTotal = $horas." horas ".$min." minutos";

        elseif($horas == 0 and $min != 0)
            $tempoTotal = $min." minutos";   

        else
            $tempoTotal = $horas." horas";

        echo "<br><p><b>Duração total estimada:</b> ".$tempoTotal."</p>";
        echo "<p><b>Preço total estimado:</b> ".$precoTotal." reais</p>";
?>