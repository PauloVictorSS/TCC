<?php

    $cont = 0;

    //Fazendo a consulta de todos os agendamentos que tem a mesma data
    $consulta2 = "SELECT * FROM agendamento WHERE data_agendada = '".$data_escolhida->format("Y-m-d")."' ORDER BY hora_agendada";
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


?>