Gerenciar Agenda
<hr>
<br>
<div class="agendamentos_feitos left">
<?php

    $consulta2 = "SELECT * FROM agendamento ORDER BY data_agendada";
    $result2 = mysqli_query($conexao, $consulta2);

    $agendamentos = array();

    while($aged = mysqli_fetch_array($result2)){

        $agendamentos[$aged["id"]] = $aged["id"];
      
        $usuario = "select * from cliente where id = ".$aged["id_cliente"];

        $result = mysqli_query($conexao, $usuario);

        $infs_usuario = mysqli_fetch_array($result);

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

                unset($servicos_agendados[count($servicos_agendados) - 1]);

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
                    <th colspan="2" class="title">Serviços Agendados</th>
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
                <tr>
                    <td>Nome e Email</td>
                    <td><?php echo $infs_usuario["nome"]; ?> - <?php echo $infs_usuario["email"]; ?></td>
                </tr>
            </table>
<?php 
        }
    }
?>
</div>
<div class="agenda_hoje right">
    <p>Hoje: <?php echo date('d/m'); ?> </p>
<?php

    $hoje = "22/10/2020";

    $consulta2 = "SELECT * FROM agendamento WHERE data_agendada='".$hoje."' ORDER BY hora_agendada";
    $result2 = mysqli_query($conexao, $consulta2);

    $agendamentos = array();

    while($aged = mysqli_fetch_array($result2)){

        $agendamentos[$aged["id"]] = $aged["id"];
    
        $usuario = "select * from cliente where id = ".$aged["id_cliente"];

        $result = mysqli_query($conexao, $usuario);

        $infs_usuario = mysqli_fetch_array($result);

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

                unset($servicos_agendados[count($servicos_agendados) - 1]);

                if($horas != 0 and $min != 0)
                    $duracao = $horas." horas ".$min." minutos";
                elseif($horas == 0 and $min != 0)
                    $duracao = $min." minutos";   
                else
                    $duracao = $horas." horas";
            }
?>
        <div class="agendamento">
            <p><?php echo $hora_agendada; ?> - <?php echo $infs_usuario["nome"]; ?> - <?php echo $duracao; ?></p>
        </div>
<?php 
        }
    }
?>
<div class="clear"></div>
</div>
<div class="clear"></div>