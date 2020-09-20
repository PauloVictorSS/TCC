<?php

    if(isset($_POST["action"])){

        $atual = new DateTime();
		$data_escolhida = new DateTime($_POST["dia"]);
		
		if($data_escolhida->format('w') <= 1)
			echo "<div class='mensagem red'>Neste dia não estaremos funcionando</div>";
		elseif($atual->format('d/m/Y') <= $data_escolhida->format('d/m/Y')){

			$_SESSION["data_escolhida"] = $data_escolhida;

			header("Location: ".INCLUDE_PATH."escolher_horario");
		}
		else
			echo "<div class='mensagem red'>Data não disponível, tente escolher um dia após o dia de hoje</div>";

    }else{

		if(isset($_SESSION["data_escolhida"]))
			unset(
				$_SESSION["data_escolhida"]
			);

		if(isset($_SESSION["horario_escolhido"]))
			unset(
				$_SESSION["horario_escolhido"],
				$_SESSION["hora_Prevista_Saida"]
			);

		if(isset($_SESSION["aviso"])){
			echo "<div class='mensagem red'>Com base na duração total estimada dos serviços escolhidos, não há horários disponíveis para esta data</div>";

			unset(
				$_SESSION["aviso"]
			);
		}

	}

	//Setando as informações dos serviços escolhidos junto com o preço e o tempo estimado
	include("php/agendamento/mostraPrecoTempo.php");

?>
<section class="agendamento">
    <h2>Escolha o dia para o servico</h2>
    <div class="text">

		<p><b>Serviços escolhidos:</b></p>
		<?php 

            foreach ($nomesServicosEscolhidos as $key => $nome) {
                echo "<p>$nome</p>";
            }

		?>

		<br><p><b>Duração total estimada: </b><?php echo $tempo; ?></p>
		<p><b>Preço total estimado: </b><?php echo $precoTotal; ?></p>

    </div>
	<form action="<?php echo INCLUDE_PATH; ?>escolher_dia" method="POST">

        <label for="dia">Escolha o dia:</label>
        <input type="date" name="dia" id="dia" required>
        <a href="<?php echo INCLUDE_PATH; ?>escolher_servicos" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar</a>
        
		<button type="submit" value="acao" class="right" name="action">Prosseguir  <i class='fa fa-arrow-right' aria-hidden='true'></i></button>
		<div class="clear"></div>
	</form>
</section>