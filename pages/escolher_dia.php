<?php

    if(isset($_POST["action"])){

        $atual = new DateTime();
		$data_escolhida = new DateTime($_POST["dia"]);
		
		if($data_escolhida->format('w') <= 1)
			echo "Neste dia não estaremos funcionando :(";
		elseif($atual->format('d/m/Y') <= $data_escolhida->format('d/m/Y')){

			$_SESSION["data_escolhida"] = $data_escolhida;

			header("Location: ".INCLUDE_PATH."escolher_horario");
		}
		else
			echo "Data não disponível, tente escolher um dia após o dia de hoje";

    }

?>
<section class="agendamento">
    <h2>Escolha o dia para o servico</h2>
    <div class="text">
		<?php include("php/agendar_precoTempo.php"); ?>
    </div>
	<form action="<?php echo INCLUDE_PATH; ?>escolher_dia" method="POST">

        <label for="dia">Escolha o dia:</label>
        <input type="date" name="dia" id="dia" required>
        <a href="<?php echo INCLUDE_PATH; ?>escolher_servicos" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar</a>
        
		<button type="submit" value="acao" class="right" name="action">Prosseguir  <i class='fa fa-arrow-right' aria-hidden='true'></i></button>
		<div class="clear"></div>
	</form>
</section>