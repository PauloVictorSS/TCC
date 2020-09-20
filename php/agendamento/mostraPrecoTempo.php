<?php

        if(isset($_POST['servicos'])){
            $servicos = $_POST['servicos'];
            $_SESSION["servicosEscolhidos"] = array();
        }
        else
            $servicos = $_SESSION["servicosEscolhidos"]; 

        $_SESSION["duracaoServicosEscolhidos"] = 0;
        $precoTotal = 0;

        echo "<p><b>Serviços escolhidos:</b></p>";

        foreach ($servicos as $key => $id) {    

            $_SESSION["servicosEscolhidos"][$key] = $id;

            $query = "SELECT nome, tempo, preco FROM `servicos_prestados` WHERE id='$id'";

            $result = mysqli_query($conexao, $query);

            while ($infs = mysqli_fetch_array($result)) {
                
                $_SESSION["duracaoServicosEscolhidos"] += $infs['tempo'];
                $precoTotal += $infs['preco'];

                echo "<p>".$infs['nome']."</p>";
            }

        }

        $duracaoMinutos = $_SESSION["duracaoServicosEscolhidos"];

        $horas = intdiv($duracaoMinutos, 60);
        $min = $duracaoMinutos % 60;

        if($horas != 0 and $min != 0)
            $duracaoMinutos = $horas." horas ".$min." minutos";

        elseif($horas == 0 and $min != 0)
            $duracaoMinutos = $min." minutos";   

        else
            $duracaoMinutos = $horas." horas";

        echo "<br><p><b>Duração total estimada:</b> ".$duracaoMinutos."</p>";
        echo "<p><b>Preço total estimado:</b> ".$precoTotal." reais</p>";
?>