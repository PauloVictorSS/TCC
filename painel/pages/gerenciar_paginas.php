Gerenciar Paginas
<hr>
<br>
<div class="paginas">
    <table>
        <tr>
            <th>Nome</th>
            <th>Conteúdo</th>
            <th>Alteração</th>
        </tr>
        <?php
            if(isset($_POST["action"])){

                $select = "SELECT * FROM textos WHERE id = ".$_POST['action']." and texto = '".$_POST["newText"]."'";

                $resultado1 = mysqli_query($conexao, $select);

                if(mysqli_num_rows($resultado1) != 1){

                    $alterar = "UPDATE textos SET texto ='".$_POST["newText"]."' WHERE id =".$_POST['action'];
            
                    $resultado2 = mysqli_query($conexao, $alterar);

                    if(mysqli_affected_rows($conexao) != 0)
                        echo "<div class='mensagem green'>Texto alterado com sucesso</div>";
                    else
                        echo "<div class='mensagem red'>Houve algum erro</div>";
                }
            }

            $consulta = "SELECT * FROM textos ORDER BY titulo";
            $result = mysqli_query($conexao, $consulta);

            while($lista = mysqli_fetch_array($result)){

                echo "<tr><form action='Gerenciar-Paginas' method='POST' class='form_infs'>";
                echo "<td>".$lista["titulo"]."</td>";
                echo "<td><textarea name='newText'>".$lista['texto']."</textarea></td>";
                echo "<td><button name='action' value='".$lista['id']."' class='green'>Salvar</button></td></form></tr>";
                
            }
        ?>

    </table>
    <br><br>
    Horários de entrada e saída
    <br><br>
    <table class="infs_horarios">
        <tr>
            <th>Dia da Semana</th>
            <th>Entrada e saída</th>
            <th>Alteração</th>
        </tr>
        <?php
            if(isset($_POST["action2"])){

                $select = "SELECT * FROM horarios WHERE id = ".$_POST['action2']." and hora_inicio = '".$_POST["newInicio"]."' and hora_termino = '".$_POST["newTermino"]."'";

                $resultado1 = mysqli_query($conexao, $select);

                if(mysqli_num_rows($resultado1) != 1){

                    $alterar = "UPDATE horarios SET hora_inicio ='".$_POST["newInicio"]."', hora_termino ='".$_POST["newTermino"]."' WHERE id =".$_POST['action2'];
            
                    $resultado2 = mysqli_query($conexao, $alterar);

                    if(mysqli_affected_rows($conexao) != 0)
                        echo "<div class='mensagem green'>Texto alterado com sucesso</div>";
                    else
                        echo "<div class='mensagem red'>Houve algum erro</div>";
                }
            }

            $consulta = "SELECT * FROM horarios";
            $result = mysqli_query($conexao, $consulta);

            while($lista = mysqli_fetch_array($result)){

                echo "<tr><form action='Gerenciar-Paginas' method='POST' class='form_infs'>";
                echo "<td>".$lista["dia"]."</td>";
                echo "<td><div class='input'>Início:<br><input name='newInicio' value='".$lista['hora_inicio']."'><br></div></div><div class='input'>Saída:<br><input name='newTermino' value='".$lista['hora_termino']."'></div></td>";
                echo "<td><button name='action2' value='".$lista['id']."' class='green'>Salvar</button></td></form></tr>";
                
            }
        ?>
    </table>
    <aside>* Caso não tenha trabalho no dia, coloque o valor 0 *</aside>
</div>