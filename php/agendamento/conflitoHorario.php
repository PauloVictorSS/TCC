<?php

    $key = 0;
    $array_horarios_disponiveis = array();

    //Começo da comparação entre o horário previsto de saida e o horário de fechamento do salão
    while($hora_Prevista_saida->format('H:i') <= $horario_max->format('H:i')){

        //Verificando se já foi feito todas as verificações de conflitos de horários
        if($cont < $qtd_agendamentos){

            //Verificando se o horário previsto de saida conflita com um horário já agendado
            if($hora_Prevista_saida->format('H:i') > $agendamentos_feitos['hora_agendada']){

                //Separando os minutos e os segundos ho horário que deu conflito
                $explode = explode(":", $agendamentos_feitos['hora_agendada']);

                //Pegando um Objeto DateInterval com base nos minutos
                $duracaoAgendamentoConflito = minuteToInterval($agendamentos_feitos['tempo_estimado']);

                //Setando os horários de saída e o horário disponível para o horário de início
                //do agendamento que deu conflito
                $hora_disponivel->setTime($explode[0], $explode[1]);
                $hora_Prevista_saida->setTime($explode[0], $explode[1]);

                //Adicionando aos horários de saída e no horário disponível a duração dos serviços do agendamento que deu conflito, 
                //assim, ambos os horários ficaram iguais ao horário previsto de saída desse agendamento conflitante
                $hora_disponivel->add($duracaoAgendamentoConflito);
                $hora_Prevista_saida->add($duracaoAgendamentoConflito);

                //Adicionando nesse horário a duração dos serviços escolhidos pelo cliente
                //Com isso, o horário de comparação agora tem o horário previo de saída do cliente
                $hora_Prevista_saida->add($interval_duracaoServico);

                //Pulando para o próximo agendamento feito no mesmo dia, para verificar o conflito de horário
                $cont++;
                $agendamentos_feitos = mysqli_fetch_array($result);

                //Pulando a impressão, já que neste horário específico houve conflito, indo para a próxima verificação
                continue;
            }
        }

        //Adicionando o horário disponível no array
        $array_horarios_disponiveis[$key] = "<option value='".$hora_disponivel->format('H:i')."'>".$hora_disponivel->format('H:i')."</option>";
        $key++;

        //Adicionando o intervalo (15 minutos) nos horários para fazer a próxima verificação
        $hora_disponivel->add($intervalo);
        $hora_Prevista_saida->add($intervalo);
    }


?>