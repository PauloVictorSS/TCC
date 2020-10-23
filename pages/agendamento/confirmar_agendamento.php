<?php

    //Setando as informações dos serviços escolhidos junto com o preço e o tempo estimado
    include("php/agendamento/mostraPrecoTempo.php");

    //Setando as informações do dia escolhido
    include("php/agendamento/mostraDataDia.php"); 
    
    if(isset($_POST["action"])){
        $data_agendamento = date('d/m/Y');
        $hora_escolhido = $_SESSION["horario_escolhido"];
        $hora_agendamento = date("H:i");
        $servicos="";

        $data_escolhida_format = $data_escolhida->format('Y-m-d');

        foreach ($_SESSION["servicosEscolhidos"] as $key => $value) {
            $servicos = $servicos.$value.";";
        }
        
        $id_cliente = $_SESSION["id_user"];    
        
        $comando = mysqli_query($conexao, "INSERT INTO agendamento (data_agendada, data_agendamento, hora_agendada, hora_agendamento, servico_agendados, id_cliente, tempo_estimado, preco_estimado) values ('$data_escolhida_format', '$data_agendamento', '$hora_escolhido', '$hora_agendamento', '$servicos', $id_cliente, $duracaoMinutos, $precoTotal)");

        if(mysqli_affected_rows($conexao) == 1)
            echo "<div class='mensagem green'>Agendamento confirmado</div>";
        else{
            echo "<div class='mensagem red'>Agendamento não confirmado, por favor tente mais tarde</div>";
        }

    }
    
?>
<section class="agendamento">
    <a href="<?php echo INCLUDE_PATH; ?>" class="logo"><img src="images/favicon.ico" alt="Mãe e Filhas"></a>
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
    <form action="<?php echo INCLUDE_PATH; ?>confirmar_agendamento" method="POST">

        <button type="submit" value="acao" name="action" id="btn-confirmar">Confirmar e Agendar</button>
        <div class="clear"></div>
        
        <a href="<?php echo INCLUDE_PATH; ?>escolher_horario" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar</a>
        <div class="clear"></div>

    </form>
</section>