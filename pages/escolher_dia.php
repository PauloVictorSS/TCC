<section class="escolherServicos">
    <h2>Escolha o dia para o servico</h2>
    <div class="text">
		<?php include("php/agendar_precoTempo.php"); ?>
    </div>
	<form action="" method="POST">

        <label for="dia">Escolha o dia:</label>
        <input type="date" name="dia" id="dia">

        <a href="<?php echo INCLUDE_PATH; ?>escolher_servicos" class="voltar left"><i class='fa fa-arrow-left' aria-hidden='true'></i>Voltar</a>
        
		<button type="submit" value="acao" class="right">Prosseguir  <i class='fa fa-arrow-right' aria-hidden='true'></i></button>
		<div class="clear"></div>
	</form>
</section>