<?php

        if(isset($_POST['servicos'])){
            $servicos = $_POST['servicos'];
            $_SESSION["servicosEscolhidos"] = array();
        }
        else
            $servicos = $_SESSION["servicosEscolhidos"]; 

        $_SESSION["duracaoServicosEscolhidos"] = 0;
        $precoTotal = 0;


        $nomesServicosEscolhidos = array();

        foreach ($servicos as $key => $id) {    

            $_SESSION["servicosEscolhidos"][$key] = $id;

            $query = "SELECT nome, tempo, preco FROM `servicos_prestados` WHERE id='$id'";

            $result = mysqli_query($conexao, $query);

            while ($infs = mysqli_fetch_array($result)) {
                
                $_SESSION["duracaoServicosEscolhidos"] += $infs['tempo'];
                $precoTotal += $infs['preco'];

                $nomesServicosEscolhidos[$key] = $infs['nome'];
            }

        }

        $duracaoMinutos = $_SESSION["duracaoServicosEscolhidos"];

        $horas = intdiv($_SESSION["duracaoServicosEscolhidos"], 60);
        $min = $_SESSION["duracaoServicosEscolhidos"] % 60;

        if($horas != 0 and $min != 0)
            $tempo = $horas." horas ".$min." minutos";

        elseif($horas == 0 and $min != 0)
            $tempo = $min." minutos";   

        else
            $tempo = $horas." horas";


        
?>