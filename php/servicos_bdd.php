<?php

    if(mysqli_num_rows($limite) != 0){
    
        $url = INCLUDE_PATH.'agendar_servico';
    
            while($num_rows = mysqli_fetch_array($limite)){


                $id = $num_rows['id'];
                echo "<tr>";
                    echo "<td class='nome'>".$num_rows['nome']."</td>";
                    echo "<td class=''>".$num_rows['tempo']."</td>";
                    echo "<td>"."R$".$num_rows['preco'].",00"."</td>";
                    echo "<td class='btn-ir'> <form action='$url' method='POST'><button type='submit' value='$id' name='idServico'><i class='fa  fa-arrow-right' aria-hidden='true'></i></button></form></td>";
                echo "</tr>";
                
            }
        
        echo "</table><br>";
        echo "</div>";
    }
    else
        echo "<h2>Desculpe, não há serviços dispoiveis.</h2>";

?>