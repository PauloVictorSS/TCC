<?php

    //Setando as informações dos serviços escolhidos junto com o preço e o tempo estimado
    include("php/agendamento/mostraPrecoTempo.php");

    //Setando as informações do dia escolhido
    include("php/agendamento/mostraDataDia.php"); 

?>
<section class="agendamento">
    <h2>Confirmar Agendamento</h2>
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
        
        <br><p><b>Horário escolhido: </b><?php echo $_SESSION["horario_escolhido"]; ?></p>
        <p><b>Horário prévio de saída: </b><?php echo $_SESSION["hora_Prevista_Saida"]; ?></p>

    </div>
    <form action="<?php echo INCLUDE_PATH; ?>escolher_horario" method="POST">

        <button type="submit" value="acao" name="action" id="btn-confirmar">Confirmar e Agendar</button>
        <div class="clear"></div>
        
        <a href="<?php echo INCLUDE_PATH; ?>escolher_horario" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar</a>
        <div class="clear"></div>

    </form>

</section>