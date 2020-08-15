<div id="divAgendar">
	<h1>_</h1>
	<h1>Agende um Horário</h1><br><br>
	<form action="" method="POST" id="formAgendar">
				
		<?php 	include("php/agendar_recuperaServico.php");	 ?>

		<label for='dataAgendamento'>Data:</label>
		<input type='date' id='dataAgendamento' name='dataAgendamento'>
		<br><br><br>
		<input type="submit" id="btnAgendar" value="Agendar">

	</form>
	<br><br>
	<a href='lista_servicos.php'>Escolher outro serviço</a>
	<br><br>
</div>