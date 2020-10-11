<?php 
    
    include "../config.php";
    include "../database/conexao_mysql.php";  
    
    if(isset($_POST["btn-foto"])){
        $imagem = $_FILES['image']['tmp_name'];
        $tamanho = $_FILES['image']['size'];
        $tipoImg = $_FILES['image']['type'];
        $nome = $_FILES['image']['name'];

        if(!empty($imagem)){
            $fp = fopen($imagem, "rb");
            $conteudo = fread($fp, $tamanho);
            $conteudo = addslashes($conteudo);
            $data_hoje = date('d/m/Y');
            $id_user = $_SESSION["id_user"];

            $insercao = "INSERT INTO fotos (tamanho, id_cliente, data_post, statu) VALUES ($conteudo, $id_user, '$data_hoje', 0)";

            //$executar = mysqli_query($conexao, $insercao);

            echo $insercao;
        }
        else
            $conteudo = "";
    }

?>