Gerenciar Paginas
<hr>
<br>

    <?php
        if(isset($_POST["action"])){

            $alterar = "UPDATE textos SET texto ='".$_POST['newText']."' WHERE id =".$_POST['action'];
    
            $resultado = mysqli_query($conexao, $alterar);

            if($resultado != 0){
                echo "<div class='mensagem green'>Texto alterado com sucesso</div>";
            }
    
        }

        $consulta = "SELECT * FROM textos ORDER BY titulo";
        $result = mysqli_query($conexao, $consulta);

        while($lista = mysqli_fetch_array($result)){
            
            echo "<div>";
                echo "<p>".$lista['titulo']."</p>";
                echo "<form action='Gerenciar-Paginas' method='POST'>";
                    echo "<input type='text' name='newText' value='".$lista['texto']."'></input><br>";
                    echo "<button name='action' value='".$lista['id']."' class='right'>Salvar</button>";
                echo "</form>";
            echo "</div>";
        }
    ?>