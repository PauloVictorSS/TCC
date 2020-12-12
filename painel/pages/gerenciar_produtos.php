<h2>Controle de Estoque</h2>
<hr><br>

<?php
    if(isset($_POST["acao"])){

        if($_POST["acao"] == 2){

            $id = $_POST["id"];

            $delete = "DELETE FROM produtos WHERE id = $id";

            $result = mysqli_query($conexao, $delete);

            if(mysqli_affected_rows($conexao) == 1)
                echo "<div class='mensagem green'>Produto deletado com sucesso</div>";
            else
                echo "<div class='mensagem red'>Houve algum erro</div>";
        }else if($_POST["acao"] == 3){

            $nome_produto = $_POST["nome_prod"];
            $qtd_produto = $_POST["qtd_prod"];

            $result = mysqli_query($conexao, "INSERT INTO produtos (nome, qtd) VALUES ('$nome_produto', $qtd_produto) ");

            if(mysqli_affected_rows($conexao) > 0)
                echo "<div class='mensagem green'>Produto adicionado com sucesso</div>";
            else
                echo "<div class='mensagem red'>Houve algum erro</div>";
        }else{

            $id = $_POST["id"];
        
            $nome = $_POST["nome"];
            $qtd_prod = $_POST["qtd"];

            $select = "SELECT * FROM produtos WHERE nome = '$nome' and qtd = $qtd_prod and id = $id";

            $result1 = mysqli_query($conexao, $select);

            if(mysqli_num_rows($result1) == 0){
                
                if($qtd_prod < 0){
                    $qtd_prod = 0;
                }

                $update = "UPDATE produtos SET nome = '$nome', qtd = $qtd_prod WHERE id = $id";

                $result2 = mysqli_query($conexao, $update);

                if(mysqli_affected_rows($conexao) == 1)
                    echo "<div class='mensagem green'>Dados do produto alterados com sucesso</div>";
                else
                    echo "<div class='mensagem red'>Houve algum erro</div>";
            }
        }
    }
?>
<div class="produtos">
    <table>
        <tr>
            <th class="title">Nome</th>
            <th class="title">Quantidade<br>(em estoque)</th>
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

        $limite = mysqli_query($conexao, "SELECT nome, qtd, id FROM produtos ORDER BY nome LIMIT $inicio,$total_reg");

        $total = mysqli_query($conexao, "SELECT nome, qtd, id FROM produtos ORDER BY nome;");

        $num_rows = mysqli_num_rows($total);

        $tr = $num_rows; // verifica o número total de registros
        $tp = $tr / $total_reg; // verifica o número total de páginas

        if($pagina == 1){
            echo "<tr><form action='".INCLUDE_PATH_PAINEL."Gerenciar-Produtos' method='post'>";
                echo"<input type='hidden' name='id' value=''>";
                echo "<td class='nome'><input type='text' name='nome_prod' placeholder='Digite o nome do produto'></td>";
                echo "<td><input type='number' name='qtd_prod' placeholder='Digite a quantidade do produto'></td>";
                echo "<td colspan='2'><button type='submit' name='acao' value='3'>Adicionar Produto</button></td>";
            echo "</form></tr>";
        }


        while($num_rows = mysqli_fetch_array($limite)){

            echo "<tr><form action='".INCLUDE_PATH_PAINEL."Gerenciar-Produtos' method='post'>";
                echo"<input type='hidden' name='id' value='".$num_rows['id']."'>";
                echo "<td class='nome'><input type='text' name='nome_prod' value='".$num_rows['nome']."'></td>";
                echo "<td>"."<input type='number' name='qtd' value='".$num_rows['qtd']."'>"."</td>";
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