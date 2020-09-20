<?php

    if(mysqli_num_rows($limite) != 0){

            while($num_rows = mysqli_fetch_array($limite)){

                $horas = intdiv($num_rows['tempo'], 60);
                $min = $num_rows['tempo'] % 60;

                if($horas != 0 and $min != 0)
                    $text = $horas."h".$min."min";

                elseif($horas == 0 and $min != 0)
                    $text = $min." min";   

                else
                    $text = $horas." horas";
                

                $id = $num_rows['id'];
                echo "<tr>";
                    echo "<td class='nome'>".$num_rows['nome']."</td>";
                    echo "<td class=''>".$text."</td>";
                    echo "<td>"."R$".$num_rows['preco'].",00"."</td>";
                echo "</tr>";
                
            }
        
        echo "</table><br>";
        echo "</div>";
    }
    else
        echo "<h2>Desculpe, não há serviços dispoiveis.</h2>";

?>