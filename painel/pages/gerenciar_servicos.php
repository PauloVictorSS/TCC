<h2>Gerenciamento dos Serviços</h2>
<hr><br>

<?php

    if(isset($_POST["acao"])){

        if($_POST["acao"] != 3)
            $id = $_POST["id"];

        if($_POST["acao"] == 2){

            $delete = "DELETE FROM servicos_prestados WHERE id = $id";

            $result = mysqli_query($conexao, $delete);

            if(mysqli_affected_rows($conexao) == 1)
                echo "<div class='mensagem green'>Serviço deletado com sucesso</div>";
            else
                echo "<div class='mensagem red'>Houve algum erro</div>";

        }else if($_POST["acao"] == 3){

            $nome = $_POST["nome"];
            $preco = $_POST["preco"];
            $tempo = $_POST["tempo"];

            if($tempo < 0)
                $tempo = 0;
            if($preco < 0)
                $preco = 0;
            
            $result = mysqli_query($conexao, "INSERT INTO servicos_prestados (nome, tempo, preco) VALUES ('$nome', $tempo, $preco) ");

            if(mysqli_affected_rows($conexao) > 0)
                echo "<div class='mensagem green'>Serviço adicionado com sucesso</div>";
            else
                echo "<div class='mensagem red'>Houve algum erro</div>";
        }else{

            $nome = $_POST["nome"];
            $preco = $_POST["preco"];
            $tempo = $_POST["tempo"];

            $select = "SELECT * FROM servicos_prestados WHERE nome = '$nome' and tempo = $tempo and preco = $preco and id = $id";

            $result1 = mysqli_query($conexao, $select);

            if(mysqli_num_rows($result1) == 0){

                if($tempo < 0)
                    $tempo = 0;
                if($preco < 0)
                    $preco = 0;

                $update = "UPDATE servicos_prestados SET nome = '$nome', tempo = $tempo, preco = $preco WHERE id = $id";

                $result2 = mysqli_query($conexao, $update);

                if(mysqli_affected_rows($conexao) == 1)
                    echo "<div class='mensagem green'>Dados do serviço alterados com sucesso</div>";
                else
                    echo "<div class='mensagem red'>Houve algum erro</div>";
            }
        }
    }
?>

<div class="servicos">
    <table>
        <tr>
            <th class="title">Nome</th>
            <th class="title">Tempo estimado<br>(Em minutos)</th>
            <th class="title">Preço estimado<br>(R$)</th>
            <th class="title"></th>
            <th class="title"></th>
        </tr>
    <?php

        $pagina = 1;
            
        $total_reg = 12;

        if(!empty($_GET['pagina']))
            $pagina = $_GET['pagina'];
                        
        $pc = 1;

        if($pagina != 1)
            $pc = $pagina;
                        
        $inicio = $pc - 1;
        $inicio = $inicio * $total_reg;

        $limite = mysqli_query($conexao, "SELECT nome, tempo, preco, id FROM servicos_prestados ORDER BY nome LIMIT $inicio,$total_reg");

        $total = mysqli_query($conexao, "SELECT nome, tempo, preco, id FROM servicos_prestados ORDER BY nome;");

        $num_rows = mysqli_num_rows($total);

        $tr = $num_rows; // verifica o número total de registros
        $tp = $tr / $total_reg; // verifica o número total de páginas

        if($pagina == 1){
            echo "<tr><form action='".INCLUDE_PATH_PAINEL."Gerenciar-Servicos' method='post'>";
                echo"<input type='hidden' name='id'>";
                echo "<td class='nome'><input type='text' name='nome' placeholder='Digite o nome do serviço'></td>";
                echo "<td class=''><input type='number' name='tempo' placeholder='Digite o tempo de duração'></td>";
                echo "<td><input type='number' name='preco' placeholder='Digite o preço'></td>";
                echo "<td colspan='2'><button type='submit' name='acao' value='3'>Adicionar Serviço</button></td>";
            echo "</form></tr>";
        }

        while($num_rows = mysqli_fetch_array($limite)){

            $text = $num_rows['tempo'];

            echo "<tr><form action='".INCLUDE_PATH_PAINEL."Gerenciar-Servicos' method='post'>";
                echo"<input type='hidden' name='id' value='".$num_rows['id']."'>";
                echo "<td class='nome'><input type='text' name='nome' value='".$num_rows['nome']."'></td>";
                echo "<td class=''><input type='number' name='tempo' value='".$text."'></td>";
                echo "<td>"."<input type='number' name='preco' value='".$num_rows['preco']."'>"."</td>";
                echo "<td><button class='green' type='submit' name='acao' value='1'>Salvar</button></td>";
                echo "<td><button class='red' type='submit' name='acao' value='2'>Excluir</button></td>";
            echo "</form></tr>";
            
        }

        echo "</table><br>";


        $anterior = $pc - 1;
        $proximo = $pc + 1;

        echo"<div class='button-box'>";
        
        if ($pc > 1)
            echo "<a href='?pagina=$anterior' class='left'><i class='fa fa-arrow-left' aria-hidden='true'></i>Anterior</a>";
        if ($pc < $tp)
            echo "<a href='?pagina=$proximo' class='right'>Próxima <i class='fa fa-arrow-right' aria-hidden='true'></i></a>";

        echo"<div class='clear'></div>
        <a href='?pagina=1' id='paginacao-inicio'>INÍCIO</a>
        </div>";
    ?>
</div>