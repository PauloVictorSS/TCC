<?php

    function minuteToInterval($duracaoMinutos){
        $horas = 00;
        $min = 00;
        $horas = intdiv($duracaoMinutos, 60);
        $min = $duracaoMinutos % 60;
        $duracaoTotal = $horas.":".$min;
        $duracaoTotal = new DateTime($duracaoTotal);
        $duracao_hora = $duracaoTotal->format('H');
        $duracao_minuto = $duracaoTotal->format('i');
        $txt = 'PT'.strval($duracao_hora).'H'.strval($duracao_minuto).'M';

        return new DateInterval($txt);
    }

    function diaSemanaPortugues($diaSemanaIngles){

        if($diaSemanaIngles == 'Tuesday')
            return 'Terça-Feira';
        elseif($diaSemanaIngles == 'Wednesday')
            return 'Quarta-feira';
        elseif($diaSemanaIngles == 'Thursday')
            return 'Quinta-feira';
        elseif($diaSemanaIngles == 'Friday')
            return 'Sexta-feira';
        elseif($diaSemanaIngles == 'Saturday')
            return 'Sábado';

    }

    function clear($input) {
        global $conexao;

        $var = mysqli_escape_string($conexao, $input);

        $var = htmlspecialchars($var);

        return $var;
    }



?>