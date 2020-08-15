<?php

    $pagina = 1;
		
	$total_reg = 6;

	if(!empty($_GET['pagina']))
		$pagina = $_GET['pagina'];
					
	$pc = 1;

	if($pagina != 1)
		$pc = $pagina;
					
	$inicio = $pc - 1;
	$inicio = $inicio * $total_reg;

	$limite = mysqli_query($conexao, "SELECT nome, tempo, preco, id FROM servicos_prestados ORDER BY nome LIMIT $inicio,$total_reg");

	$total = mysqli_query($conexao, "SELECT nome, tempo, preco, id FROM servicos_prestados ORDER BY nome;");

	$num_rows = mysqli_num_rows($total);

	$tr = $num_rows; // verifica o número total de registros
    $tp = $tr / $total_reg; // verifica o número total de páginas
    
    include "php/servicos_bdd.php";

    $anterior = $pc - 1;
	$proximo = $pc + 1;
						
	echo "<br><br>";
						
	if ($pc > 1)
		echo "<a href='?pagina=$anterior' id='paginacao-anterior'><i class='fa fa-arrow-left' aria-hidden='true'></i>Anterior</a>";
						
	if ($pc < $tp)
	    echo "<a href='?pagina=$proximo' id='paginacao-proxima'>Próxima <i class='fa fa-arrow-right' aria-hidden='true'></i></a>";

?>