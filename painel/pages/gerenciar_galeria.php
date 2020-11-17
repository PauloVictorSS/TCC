<h2>Gerenciamento da Galeria</h2>
<hr><br>
<?php

    if(isset($_POST["acao"])){

        $id_foto = $_POST["id_foto"];

        if($_POST["acao"] == 1){

            $update = "UPDATE fotos SET aprovado = 1 WHERE id = $id_foto";

            $result = mysqli_query($conexao, $update);

            if(mysqli_affected_rows($conexao) == 1)
                echo "<div class='mensagem green'>Foto aprovada</div>";
            else
                echo "<div class='mensagem red'>Houve algum erro</div>";

        }else{

            $delete = "DELETE FROM fotos WHERE id = $id_foto";

            $result = mysqli_query($conexao, $delete);

            if(mysqli_affected_rows($conexao) == 1)
                echo "<div class='mensagem red'>Foto excluída</div>";
            else
                echo "<div class='mensagem red'>Houve algum erro</div>";

        }

    }
    elseif (isset($_POST["acao2"])) {
        $id_foto = $_POST["id_foto"];
        $status = $_POST["acao2"];

        $update = "UPDATE fotos SET statu = $status WHERE id = $id_foto";

        $result = mysqli_query($conexao, $update);

        if(mysqli_affected_rows($conexao) == 1)
            echo "<div class='mensagem green'>Status da foto alterado com sucesso</div>";
        else
            echo "<div class='mensagem red'>Houve algum erro</div>";

    }

    $sql = "SELECT * FROM `fotos` WHERE aprovado = 0";

    $resultado = mysqli_query($conexao, $sql);

    $cont = 1;

    if(mysqli_num_rows($resultado) > 0){

        echo"<h3>Fotos esperando por aprovação:</h3>";

        while($result = mysqli_fetch_array($resultado)){ 
            
            if($cont == 1){
                echo "<div class='bloco'>";
                $cont = 0;
            }else{
                echo "<div class='bloco direita'>";
                $cont = 1;
            }
            
            echo '<div style="background-image: url(data:image/jpeg;base64,'.base64_encode( $result['tamanho'] ).');" class="fotos"></div>';    

            echo "<form action='".INCLUDE_PATH_PAINEL."Gerenciar-Galeria' method='post'>
                    <input type='hidden' name='id_foto' value='".$result['id']."'>
                    <button type='submit' class='left green' name='acao' value='1'>Aprovar foto</button>
                    <button type='submit' class='right red' name='acao' value='2'>Excluir foto</button>
                    <div class='clear'></div>
                </form>
                <div class='clear'></div>
            </div>";
        }

    }
    else{
        echo"<h3 class='mensage'>Não há nenhuma foto a ser aprovada!</h3>";
    }

?>

<br>
<?php

    $sql = "SELECT * FROM `fotos` WHERE aprovado = 1 and statu = 0";

    $resultado = mysqli_query($conexao, $sql);

    $cont = 1;

    if(mysqli_num_rows($resultado) > 0){

        echo"<h3>Fotos que já foram aprovadas, mas não estão na galeria:</h3>";

        while($result = mysqli_fetch_array($resultado)){ 

            if($cont == 1){
                echo "<div class='bloco'>";
                $cont = 0;
            }else{
                echo "<div class='bloco direita'>";
                $cont = 1;
            }
            
            echo '<div style="background-image: url(data:image/jpeg;base64,'.base64_encode( $result['tamanho'] ).');" class="fotos"></div>';    

            echo "<form action='".INCLUDE_PATH_PAINEL."Gerenciar-Galeria' method='post'>
                    <input type='hidden' name='id_foto' value='".$result['id']."'>
                    <button type='submit' class='left green' value='1' name='acao2'>Adicionar foto na galeria</button>
                    <button type='submit' class='right red' name='acao' value='2'>Excluir foto</button>
                    <div class='clear'></div>
                </form>
                <div class='clear'></div>
            </div>";     
        }
    }else{
        echo"<h3 class='mensage'>Todas as fotos aprovadas já estão na galeria!</h3>";
    }
?>

<br><h3>Fotos que já foram aprovadas e estão na galeria:</h3>
<?php

    $sql = "SELECT * FROM `fotos` WHERE aprovado = 1 and statu = 1";

    $resultado = mysqli_query($conexao, $sql);

    $cont = 1;

    while($result = mysqli_fetch_array($resultado)){ 

        if($cont == 1){
            echo "<div class='bloco'>";
            $cont = 0;
        }else{
            echo "<div class='bloco direita'>";
            $cont = 1;
        }

        echo '<div style="background-image: url(data:image/jpeg;base64,'.base64_encode( $result['tamanho'] ).');" class="fotos"></div>';    

        echo "<form action='".INCLUDE_PATH_PAINEL."Gerenciar-Galeria' method='post'>
                <input type='hidden' name='id_foto' value='".$result['id']."'>
                <button type='submit' class='left green' value='0' name='acao2'>Remover foto da galeria</button>
                <button type='submit' class='right red' name='acao' value='2'>Excluir foto</button>
                <div class='clear'></div>
            </form>
            <div class='clear'></div>
        </div>";     
    }
?>