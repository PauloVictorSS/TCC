<section class="escolherServicos">
    <h2>Confirmar Agendamento</h2>
    <div class="text">

		<?php include("php/agendar_precoTempo.php"); ?>
        <?php include("php/agendar_dataDia.php"); ?>

    </div>
    <form action="<?php echo INCLUDE_PATH; ?>confirmar_agendamento" method="POST">
    
        <div class="escolher_horario">
            <label for="horario_escolhido">Horários disponíveis</label>
            <select name="horario_escolhido" id="horario_escolhido" required>

                <option value="">Escolha um dos horários</option>
                <?php

                    //Fazendo a consulta de todos os agendamentos que tem a mesma data
                    $consulta2 = "SELECT * FROM agendamento WHERE data_agendada = '".$data_escolhida->format("d/m/Y")."' ORDER BY hora_agendada";
                    $result = mysqli_query($conexao, $consulta2);

                    $qtd_agendamentos = mysqli_num_rows($result); //Nº total de agendamentos no mesmo dia
                    $agendamentos_feitos = mysqli_fetch_array($result); //Informações da primeira linha desta consulta

                    $cont = 0;

                    $interval_duracaoServico = minuteToInterval($duracaoMinutos); //Pegando um Objeto DateInterval com base nos minutos

                    //Criando um Objeto DateTime tanto para o horário de abertura
                    //como para o de fechamento do salão
                    $hora_disponivel = new DateTime($hora_inicio);
                    $horario_max = new DateTime($hora_termino);
                    
                    
                    $hora_Prevista_saida = new Datetime($hora_inicio); //Criando um Objeto Datetime para um horário que vai serir de comparação

                    //Adicionando nesse horário a duração dos serviços escolhidos pelo cliente
                    //Com isso, o horário de comparação agora tem o horário previo de saída do cliente
                    $hora_Prevista_saida->add($interval_duracaoServico); 

                    $intervalo = new DateInterval('PT15M'); //Criando um intervalo de 15 minutos para servir de pausa entre os horários

                    //Começo da comparação entre o horário previsto de saida e o horário de fechamento do salão
                    while($hora_Prevista_saida->format('H:i') < $horario_max->format('H:i')){

                        //Verificando se já foi feito todas as verificações de conflitos de horários
                        if($cont < $qtd_agendamentos){

                            if($hora_Prevista_saida->format('H:i') > $agendamentos_feitos['hora_agendada']){

                                $explode = explode(":", $agendamentos_feitos['hora_agendada']);
                                $horarioIgual = minuteToInterval($agendamentos_feitos['tempo_estimado']);

                                $hora_disponivel->setTime($explode[0], $explode[1]);
                                $hora_Prevista_saida->setTime($explode[0], $explode[1]);

                                $hora_disponivel->add($horarioIgual);
                                $hora_Prevista_saida->add($horarioIgual);

                                $hora_Prevista_saida->add($interval_duracaoServico);

                                $cont++;
                                $hora_disponivel->add($intervalo);
                                $hora_Prevista_saida->add($intervalo);
                                $agendamentos_feitos = mysqli_fetch_array($result);

                                continue;
                            }
                        }

                        //Imprimindo na tela um horário disponível para agendamento
                        echo "<option value='".$hora_disponivel->format('H:i')."'>".$hora_disponivel->format('H:i')."</option>";

                        //Adicionando o intervalo (15 minutos) nos horários para fazer outra verificação
                        $hora_disponivel->add($intervalo);
                        $hora_Prevista_saida->add($intervalo);
                    }

                ?>
            </select>
        </div>

        <button type="submit" value="acao" class="right" name="action">Prosseguir  <i class='fa fa-arrow-right' aria-hidden='true'></i></button>
        <a href="<?php echo INCLUDE_PATH; ?>escolher_dia" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar</a>
        <div class="clear"></div>
    </form>

</section>