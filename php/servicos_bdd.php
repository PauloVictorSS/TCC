<?php

    if(mysqli_num_rows($limite) != 0){
        echo "<h1>_</h1>";
        echo "<h1>Lista de serviços</h1><br>";
    
        echo "<div id='tab_agende'>";
        echo "<table>";
    
            while($num_rows = mysqli_fetch_array($limite)){

                $id = $num_rows['id'];
                echo "<tr>";
                    echo "<td class='nome'>".$num_rows['nome']."</td>";
                    echo "<td class=''>".$num_rows['tempo']."</td>";
                    echo "<td>"."R$".$num_rows['preco'].",00"."</td>";
                    echo "<td class='btn-ir'> <form action='agendar_servico.php' method='POST'><button type='submit' value='$id' name='idServico'><i class='fa  fa-arrow-right' aria-hidden='true'></i></button></form></td>";
                echo "</tr>";
                
            }
        
        echo "</table><br>";
        echo "</div>";
    }
    else
        echo "<h2>Desculpe, não há serviços dispoiveis.</h2>";

?>