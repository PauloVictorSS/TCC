<section class="escolherServicos">
	<h2>Escolha os serviços para agendar</h2>
	<form action="<?php echo INCLUDE_PATH; ?>agendar_servico" method="POST" id="formAgendar">
		
		<button type="button" id="addServico" class="right">+ Adicionar outro serviço</button>
		<div class="clear"></div>

		<div class="selectServicos">
			<select name="servicos[]" id="servicos" required>
				<option value="">Selecione um serviço</option>
				<?php 	include("php/agendar_recuperaServico.php");	 ?>
			</select>
		</div>

		<button type="submit" value="acao" class="right">Prosseguir  <i class='fa fa-arrow-right' aria-hidden='true'></i></button>
		<div class="clear"></div>
	</form>
</section>