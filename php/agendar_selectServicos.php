<?php

        $result = mysqli_query($conexao, "SELECT * FROM `servicos_prestados`");

        while($servico = mysqli_fetch_array($result)){

            $nome = $servico['nome'];
            $id = $servico['id'];
            $preco = $servico['preco'];

            echo "<option value=".$id.">$nome</option>";

        }
?>