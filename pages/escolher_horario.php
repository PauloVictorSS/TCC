<?php

    if(isset($_POST["action"])){

        $_SESSION["horario_escolhido"] = $_POST["horario_escolhido"];

        $hora_escolhida = new DateTime($_POST["horario_escolhido"]);

        $_SESSION["hora_Prevista_Saida"] = $hora_escolhida->add(minuteToInterval($_SESSION["duracaoServicosEscolhidos"]))->format("H:i");

        header("Location: ".INCLUDE_PATH."confirmar_agendamento");
    }

?>

<section class="agendamento">
    <h2>Escolher Horário</h2>
    <div class="text">

        <?php 
            //Mostrando as informações dos serviços escolhidos junto com o preço e o tempo estimado
            include("php/agendar_precoTempo.php");
            //Mostrando as informações do dia escolhiodo
            include("php/agendar_dataDia.php"); 
        ?>

    </div>
    <form action="<?php echo INCLUDE_PATH; ?>escolher_horario" method="POST">

        <label for="horario_escolhido">Horários disponíveis:</label>
        <select name="horario_escolhido" id="horario_escolhido" required>

            <option value="">Escolha um dos horários</option>
            <?php

                $cont = 0;

                //Fazendo a consulta de todos os agendamentos que tem a mesma data
                $consulta2 = "SELECT * FROM agendamento WHERE data_agendada = '".$data_escolhida->format("d/m/Y")."' ORDER BY hora_agendada";
                $result = mysqli_query($conexao, $consulta2);

                $qtd_agendamentos = mysqli_num_rows($result); //Nº total de agendamentos no mesmo dia
                $agendamentos_feitos = mysqli_fetch_array($result); //Informações da primeira linha desta consulta

                //Pegando um Objeto DateInterval com base nos minutos
                $interval_duracaoServico = minuteToInterval($duracaoMinutos); 

                //Criando um Objeto DateTime tanto para o horário de abertura
                //como para o de fechamento do salão
                $hora_disponivel = new DateTime($hora_inicio);
                $horario_max = new DateTime($hora_termino);
                
                //Criando um Objeto Datetime para um horário que vai serir de comparação
                $hora_Prevista_saida = new Datetime($hora_inicio); 

                //Adicionando nesse horário a duração dos serviços escolhidos pelo cliente
                //Com isso, o horário de comparação agora tem o horário previo de saída do cliente
                $hora_Prevista_saida->add($interval_duracaoServico); 

                //Criando um intervalo de 15 minutos para servir de pausa entre os horários
                $intervalo = new DateInterval('PT15M'); 

                //Incluindo o código para verificar e resolver os conflitos de horários
                include("php/agendar_conflitoHorario.php");

            ?>
        </select>

        <button type="submit" value="acao" class="right" name="action">Prosseguir  <i class='fa fa-arrow-right' aria-hidden='true'></i></button>
        <a href="<?php echo INCLUDE_PATH; ?>escolher_dia" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar</a>
        <div class="clear"></div>
    </form>

</section>