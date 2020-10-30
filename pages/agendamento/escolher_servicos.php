<?php

	if(isset($_SESSION["servicosEscolhidos"]))
		unset(
			$_SESSION["servicosEscolhidos"],
			$_SESSION["duracaoServicosEscolhidos"]
		);

	if(isset($_SESSION["data_escolhida"]))
		unset(
			$_SESSION["data_escolhida"]
		);

	if(isset($_SESSION["horario_escolhido"]))
		unset(
			$_SESSION["horario_escolhido"],
			$_SESSION["hora_Prevista_Saida"]
		);
	

?>

<section class="agendamento">
    <a href="<?php echo INCLUDE_PATH; ?>" class="logo"><img src="images/favicon.ico" alt="Mãe e Filhas"></a>
	<h2>Escolha os serviços para agendar</h2>
	<form action="<?php echo INCLUDE_PATH; ?>escolher_dia" method="POST" id="formAgendar">
		
		<button type="button" id="addServico" class="right">+ Adicionar outro serviço</button>
		<div class="clear"></div>

		<div class="selectServicos">
			<select name="servicos[]" id="servicos" required>
				<option value="">Selecione um serviço</option>
				<?php 	include("php/agendamento/mostraServicos.php");	 ?>
			</select>
		</div>

		<button type="submit" value="acao" class="right">Prosseguir  <i class='fa fa-arrow-right' aria-hidden='true'></i></button>
		<div class="clear"></div>
	</form>
</section>

<script>
	document.querySelector("#addServico").addEventListener("click", cloneField)

	function cloneField(){

        const fields = document.querySelectorAll(".selectServicos #servicos");

        if(fields.length < 7){
            const field = document.querySelector(".selectServicos #servicos").cloneNode(true)

            document.querySelector(".selectServicos").appendChild(field)
        }
	}

</script>