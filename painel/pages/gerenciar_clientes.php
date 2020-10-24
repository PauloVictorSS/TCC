<h2>Gerenciar Clientes</h2>
<hr><br>
<table id="clientes">
    <tr>
        <th>E-mail</th>
        <th>Nome - Telefone</th>
        
    </tr>
    <?php

        $select = "SELECT * FROM cliente ORDER BY nome";

        $result = mysqli_query($conexao, $select);

        while($infs = mysqli_fetch_array($result)){  

    ?>

        <tr>
            <td><?php echo $infs["email"];  ?></td>
            <td><?php echo $infs["nome"];  ?> - <?php echo $infs["telefone"];  ?></td>
        </tr>

    <?php

        }

    ?>
</table>