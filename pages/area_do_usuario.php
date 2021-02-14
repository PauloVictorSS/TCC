<?php     
    include "../config.php";
    include "../database/conexao_mysql.php";     

    $select = "select * from cliente where id=".$_SESSION["id_user"];    
    $result = mysqli_query($conexao, $select);

    $user = mysqli_fetch_array($result);

    if(isset($_POST["action"])){

        $delete = "DELETE FROM agendamento WHERE id =".$_POST["action"];

        $resultado = mysqli_query($conexao, $delete);

    }

    $consulta = "SELECT * FROM cliente WHERE id = ".$_SESSION["id_user"];

    $result = mysqli_query($conexao, $consulta);

    $infs = mysqli_fetch_array($result);

    $nome = $infs["nome"];
    $tel = $infs["telefone"];
    $email = $infs["email"];

    $consulta2 = "SELECT * FROM agendamento WHERE id_cliente = ".$_SESSION["id_user"]." ORDER BY data_agendada";

    $result2 = mysqli_query($conexao, $consulta2);

    $agendamentos = array();

    while($aged = mysqli_fetch_array($result2)){
        $agendamentos[$aged["id"]] = $aged["id"];
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Salão de Beleza Mãe e Filhas</title>
		<meta name="description" content="Salão de Beleza">
		<meta name="robots" content="index, follow">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/main.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/main.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;700&family=Noto+Sans&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Rubik:ital@1&display=swap" rel="stylesheet"> 
		<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&family=Yellowtail&display=swap" rel="stylesheet">
        <link rel="icon" href="<?php echo INCLUDE_PATH; ?>images/favicon.ico" type="image/x-icon">
    </head>
    <body id="body_area_func">
        <section class="area_func">
            <div class="inf-func">
                <div class="avatar-func">
                    <img src="<?php echo INCLUDE_PATH; ?>images/padrao.jpg" class="left">

                    <div class="text-func">
                        <p>Olá <?php echo $user["nome"]; ?></p>
                        <p class="left">Status:   </p>
                        <p id="status"> <div class="bola"></div> Online</p>
                        
                    </div>

                    <div class="clear"></div>
                    <a href="<?php echo INCLUDE_PATH;?>escolher_servicos"><i class="fa fa-calendar" aria-hidden="true"></i> Agendar um Serviço</a>
                </div>
            </div>
            <div class="clear"></div>
            <div class="titulo">
                <a href="../php/loggout.php" class="right"> <i class="fa fa-sign-out"></i>Logout</a>
                <a href="<?php echo INCLUDE_PATH; ?>" class="right"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                <h1>Area do Cliente</h1>
            </div>
            <div class="clear"></div>
            <div class="page">
                <?php
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

                            $insercao = "INSERT INTO fotos (tamanho, id_cliente, data_post, aprovado, statu) VALUES ('$conteudo', $id_user, '$data_hoje', 0, 0)";

                            $executar = mysqli_query($conexao, $insercao);
                            if(mysqli_affected_rows($conexao) == 1)
                                echo "<div class='mensagem green'>Imagem enviada com sucesso</div>";
                            else
                                echo "<div class='mensagem red'>Imagem não enviada, por favor tente mais tarde</div>";
                        }
                        else{
                            $conteudo = "";
                        }

                    }
                ?>
                <div class="area_trabalho"> 
                    <br>
                    <h3>Enviar uma foto a galeria do site</h3>
                    <hr>
                    <form enctype="multipart/form-data" action="area_do_usuario.php" method="POST" id="imagem" class="formulario">
                        <label for="image">Escolha uma foto:</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                        <input type="file" name="image">
                        <button type="submit" value="2"  name="btn-foto" form="imagem" class="btn-enviar">Enviar</button>
                    </form>
                    <br><br>
                    <h3>Serviços agendados</h3>
                    <hr>
                    <div class="agendamentos">
                    <?php  
                        foreach ($agendamentos as $key => $value) {
                            $consulta3 = "SELECT * FROM agendamento WHERE id = $value";

                            $result3 = mysqli_query($conexao, $consulta3);
                            
                            $agendamentos = array();
                            
                            while($aged = mysqli_fetch_array($result3)){
                            
                                $data_agendada = $aged["data_agendada"];
                                $hora_agendada = $aged["hora_agendada"];
                                $servicos_agendados = explode(";", $aged["servico_agendados"]);
                                $duracao = $aged["tempo_estimado"];
                                $preco = "R$".$aged["preco_estimado"].",00";

                                $horas = intdiv($duracao, 60);
                                $min = $duracao % 60;

                                unset($servicos_agendados[count($servicos_agendados) - 1]);

                                if($horas != 0 and $min != 0)
                                    $duracao = $horas." horas ".$min." minutos";
                                elseif($horas == 0 and $min != 0)
                                    $duracao = $min." minutos";   
                                else
                                    $duracao = $horas." horas";
                            }
                    ?>
                        <table class="agendamentos_feitos">
                            <tr>
                                <th colspan="2" class="title">        
                                <form action="area_do_usuario.php" method="POST">
                                    <button name="action" value="<?php echo $value; ?>" class="right"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>                               
                                Serviços Agendados</th>
                                <div class="clear"></div>
                            </tr>
                            <tr>
                                <td colspan="2" class="servicos">
                                <?php                               
                                    foreach ($servicos_agendados as $key => $value) {
                                        $consulta4 = "SELECT nome FROM servicos_prestados WHERE id = $value";     
                                        $result4 = mysqli_query($conexao, $consulta4);      
                                        while($nome = mysqli_fetch_array($result4)){       
                                            echo "<p>".$nome[0]."</p>";
                                        }
                                    }
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Data escolhida</td>
                                <td><?php echo date( 'd/m/Y' , strtotime($data_agendada) ); ?></td>
                            </tr>
                            <tr>
                                <td>Horário escolhido</td>
                                <td><?php echo $hora_agendada; ?></td>
                            </tr>
                            <tr>
                                <td>Duração</td>
                                <td><?php echo $duracao; ?></td>
                            </tr>
                            <tr>
                                <td>Preço</td>
                                <td><?php echo $preco; ?></td>
                            </tr>
                        </table>
                    <?php 
                        }
                    ?>
                </div>
                <div class="clear"></div>
                </div>
            </div>
        </section>  

        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/galeria.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/menu.js"></script>
	</body>
</html>