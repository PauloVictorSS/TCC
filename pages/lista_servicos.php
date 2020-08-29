<section class='servicos'>

	<h1>Lista de serviços</h1>
	<div id='tab_agende'>
    	<table>
			<tr>
				<th class="title">Nome</th>
				<th class="title">Tempo estimado</th>
				<th class="title">Preço estimado</th>
				<th id="lastTitle"></th>
			</tr>
		<?php 	include "php/servicos_listagem.php";	?>

	<div class="clear"></div>
	<a href='?pagina=1' id='paginacao-inicio'>INÍCIO</a>
	</div>

</section>
