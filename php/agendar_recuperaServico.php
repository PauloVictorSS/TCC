<?php

        $id = $_POST["idServico"];

        $result = mysqli_query($conexao, "SELECT * FROM `servicos_prestados` where id='$id'");

        while($num_rows = mysqli_fetch_array($result)){

            $nome = $num_rows['nome'];

            echo "<label for='servico'><b>Serviço Escolhido:</b></label><br><input type='text' value='$nome' disabled id='servicoEscolhido'><br><br>";

        }
?>