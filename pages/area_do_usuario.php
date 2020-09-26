<?php     
    include "../config.php";
    include "../database/conexao_mysql.php";     
?>
<?php

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

    $consulta2 = "SELECT * FROM agendamento WHERE id_cliente = ".$_SESSION["id_user"];

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
		<link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/main.css">
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
    <body id="body_area_usuario">
        
        <section class="area_usuario">

                <div class="inf-usuario">
                    <div class="avatar-usuario">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="infs">
                        <h4>Email:<br><?php echo $email;?></h4>
                        <table class="dados_pessoais">
                            <tr>
                                <th colspan="2">Dados Pessoais</th>
                            </tr>
                            <tr>
                                <td>Nome</td>
                                <td><?php echo $nome;?></td>
                            </tr>
                            <tr>
                                <td>Telefone</td>
                                <td><?php echo $tel;?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="buttons">
                        <a href="<?php echo INCLUDE_PATH; ?>escolher_servicos" id="agendar">Agendar serviço</a>
                        <div class="clear"></div>
                        <a href="../php/loggout.php" class="right"><br><i class="fa fa-sign-out"></i> Logout</a>
                        <a href="<?php echo INCLUDE_PATH; ?>" class="left"><br><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                        <div class="clear"></div>
                    </div>
                    
                </div>
                <div class="titulo">
                    <h1>Agendamentos</h1>
                </div>
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
                                <td><?php echo $data_agendada; ?></td>
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

                        <?php }?>
                    
                </div>
                <div class="clear"></div>

        </section>


        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/galeria.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
        <script src="<?php echo INCLUDE_PATH; ?>js/menu.js"></script>
	</body>
</html>