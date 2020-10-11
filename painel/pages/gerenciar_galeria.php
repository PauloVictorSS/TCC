<h2>Gerenciamento da Galeria</h2>
<hr><br>
<?php

    if(isset($_POST["acao"])){

        $id_foto = $_POST["id_foto"];

        if($_POST["acao"] == 1){

            $update = "UPDATE fotos SET statu = 1 WHERE id = $id_foto";

            $result = mysqli_query($conexao, $update);

            if(mysqli_affected_rows($conexao) == 1)
                echo "<div class='mensagem green'>Foto adicionada à galeria</div>";
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

    $sql = "SELECT * FROM `fotos` WHERE statu = 0";

    $resultado = mysqli_query($conexao, $sql);

    $cont = 1;

    while($result = mysqli_fetch_array($resultado)){ 

        if($cont == 1){
            echo "<div class='bloco'>";

            echo '<div style="background-image: url(data:image/jpeg;base64,'.base64_encode( $result['tamanho'] ).');" class="fotos"></div>';    

            echo "<form action='".INCLUDE_PATH_PAINEL."Gerenciar-Galeria' method='post'>
                    <input type='hidden' name='id_foto' value='".$result['id']."'>
                    <button type='submit' class='left green' name='acao' value='1'>Adicionar à galeria</button>
                    <button type='submit' class='right red' name='acao' value='2'>Excluir foto</button>
                    <div class='clear'></div>
                </form>
                <div class='clear'></div>
            </div>";

            $cont = 0;
        }else{
            echo "<div class='bloco direita'>";

            echo '<div style="background-image: url(data:image/jpeg;base64,'.base64_encode( $result['tamanho'] ).');" class="fotos"></div>';    

            echo "<form action='".INCLUDE_PATH_PAINEL."Gerenciar-Galeria' method='post'>
                    <input type='hidden' name='id_foto' value='".$result['id']."'>
                    <button type='submit' class='left green' name='acao' value='1'>Adicionar à galeria</button>
                    <button type='submit' class='right red' name='acao' value='2'>Excluir foto</button>
                    <div class='clear'></div>
                </form>
                <div class='clear'></div>
            </div><div class='clear'></div>";

            $cont = 1;
        }
    }

?>