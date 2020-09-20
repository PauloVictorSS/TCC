<section class="agendamento">
    <h2>Confirmar Agendamento</h2>
    <div class="text">

        <?php 

            //Mostrando as informações dos serviços escolhidos junto com o preço e o tempo estimado
            include("php/agendamento/mostraPrecoTempo.php");
            //Mostrando as informações do dia escolhiodo
            include("php/agendamento/mostraDataDia.php"); 

            echo "<br><p><b>Horário escolhido:</b> ".$_SESSION["horario_escolhido"]."</p>";
            echo "<p><b>Horário prévio de saída:</b> ".$_SESSION["hora_Prevista_Saida"]."</p>";

        ?>

    </div>
    <form action="<?php echo INCLUDE_PATH; ?>escolher_horario" method="POST">

        <button type="submit" value="acao" class="right" name="action">Confirmar e Agendar</button>
        <a href="<?php echo INCLUDE_PATH; ?>escolher_horario" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar</a>
        <div class="clear"></div>

    </form>

</section>