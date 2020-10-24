<section class="mapa">
	<h1>Localização</h1>

	<?php
		$consulta = "SELECT * FROM textos WHERE id BETWEEN 2 AND 6";
        $limite = mysqli_query($conexao, $consulta);
        if(mysqli_num_rows($limite) != 0){

            while($num_rows = mysqli_fetch_array($limite)){
                $texto = $num_rows['texto'];

                echo "<p>";
                if($num_rows['id'] == 4){
                    echo "Tel: ";
                }	
                echo "$texto</p>";
            }
        }
        echo "<br><p>HORÁRIOS DE FUNCIONAMENTO:</p>";
        
        $consulta2 = "SELECT * FROM `horarios`WHERE hora_inicio IS NOT null AND hora_termino IS NOT null GROUP BY hora_inicio, hora_termino ORDER BY id";
        $limite2 = mysqli_query($conexao, $consulta2);
        if(mysqli_num_rows($limite2) != 0){

            while($num_rows2 = mysqli_fetch_array($limite2)){
                $diaInicio = $num_rows2['dia'];
                $horaInicio = $num_rows2['hora_inicio'];
                $horaFim = $num_rows2['hora_termino'];
                $diaFim = '';
                $consulta3 = "SELECT dia FROM `horarios`WHERE hora_inicio = '$horaInicio' AND hora_termino = '$horaFim' ORDER BY id DESC LIMIT 1";
                $limite3 = mysqli_query($conexao, $consulta3);
                if(mysqli_num_rows($limite3) != 0){

                    while($num_rows3 = mysqli_fetch_array($limite3)){
                        $diaFim = $num_rows3['dia'];
                    }
                }

                echo "<br><p>$diaInicio";

                if($diaInicio != $diaFim){
                    echo "-$diaFim</p>";
                }

                echo "<p>$horaInicio-$horaFim</p>";
            }
        }
	?>

	<iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3677.190572075564!2d-47.18847708446686!3d-22.832437840963703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8bee8c7a6e4a1%3A0xd43d34e3faf3cf08!2sSal%C3%A3o%20De%20Beleza%20M%C3%A3e%20%26%20Filhas!5e0!3m2!1spt-BR!2sbr!4v1593451166289!5m2!1spt-BR!2sbr"></iframe>

</section>