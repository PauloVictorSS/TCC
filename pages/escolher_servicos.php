<div id="divAgendar">
	<h1>_</h1>
	<h1>Escolha os serviços para agendar</h1><br><br>
	<form action="<?php echo INCLUDE_PATH; ?>agendar_servico" method="POST" id="formAgendar">
		
		<button type="button" id="addServico">+Adicioanr outro serviço</button>

		<div class="selectServicos">
			<select name="servicos[]" id="servicos" required>
				<option value="">Selecione um serviço</option>
				<?php 	include("php/agendar_recuperaServico.php");	 ?>
			</select>
		</div>

		<button type="submit" value="acao">Prosseguir<i class='fa fa-arrow-right' aria-hidden='true'></i></button>
	</form>
	<br><br>
	<a href='lista_servicos.php'>Escolher outro serviço</a>
	<br><br>
</div>