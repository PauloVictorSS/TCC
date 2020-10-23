<?php

    if(isset($_POST["action"])){

        $_SESSION["horario_escolhido"] = $_POST["horario_escolhido"];

        $hora_escolhida = new DateTime($_POST["horario_escolhido"]);

        $_SESSION["hora_Prevista_Saida"] = $hora_escolhida->add(minuteToInterval($_SESSION["duracaoServicosEscolhidos"]))->format("H:i");

        header("Location: ".INCLUDE_PATH."confirmar_agendamento");
    }else{

        if(isset($_SESSION["horario_escolhido"]))
			unset(
				$_SESSION["horario_escolhido"],
				$_SESSION["hora_Prevista_Saida"]
			);
    }

     //Setando as informações dos serviços escolhidos junto com o preço e o tempo estimado
     include("php/agendamento/mostraPrecoTempo.php");

     //Setando as informações do dia escolhido
     include("php/agendamento/mostraDataDia.php"); 

     //Incluindo o código que vai criar as váriaveis necessárias para a vericação
     //dos horários disponíveis
     include("php/agendamento/preparoConflitoHorario.php");

     //Incluindo o código para verificar e resolver os conflitos de horários
     include("php/agendamento/conflitoHorario.php");

    if(count($array_horarios_disponiveis) == 0){
        $_SESSION["aviso"] = 1;
        
        header("Location: ".INCLUDE_PATH."escolher_dia");
    }

?>

<section class="agendamento">
    <a href="<?php echo INCLUDE_PATH; ?>" class="logo"><img src="images/favicon.ico" alt="Mãe e Filhas"></a>
    <h2>Escolher Horário</h2>
    <div class="text">

        <p><b>Serviços escolhidos:</b></p>
        <?php 

            foreach ($nomesServicosEscolhidos as $key => $nome) {
                echo "<p>$nome</p>";
            }

        ?>

        <br><p><b>Duração total estimada: </b><?php echo $tempo; ?></p>
        <p><b>Preço total estimado: </b>R$<?php echo $precoTotal; ?>,00</p>
        
        <br><p><b>Data escolhida: </b><?php echo $data_escolhida->format('d/m/Y'); ?></p>
		<p><b>Dia da semana: </b><?php echo diaSemanaPortugues($data_escolhida->format('l')); ?></p>

    </div>
    <form action="<?php echo INCLUDE_PATH; ?>escolher_horario" method="POST">

        <label for="horario_escolhido">Horários disponíveis:</label>
        <select name="horario_escolhido" id="horario_escolhido" required>

            <option value="">Escolha um dos horários</option>
            <?php

                
                //Mostrando todos os horários disponíveis
                foreach ($array_horarios_disponiveis as $key => $value)
                    echo $value;
                
                
            ?>
        </select>
        <button type="submit" value="acao" class="right" name="action">Prosseguir  <i class='fa fa-arrow-right' aria-hidden='true'></i></button>
        <a href="<?php echo INCLUDE_PATH; ?>escolher_dia" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar</a>
        <div class="clear"></div>
    </form>

</section>