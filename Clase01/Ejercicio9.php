<!--Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.-->

<?php

    $lapicera = array();
    $lapiceraA = array("color" => "azul", "marca"=>"BIC", "trazo"=>"fino","precio"=>100);
    $lapiceraB = array("color" => "negra", "marca"=>"Maped", "trazo"=>"grueso","precio"=>70);
    $lapiceraC = array("color" => "roja", "marca"=>"Faber-Castell", "trazo"=>"medio","precio"=>110);


    array_push($lapicera, $lapiceraA);
    array_push($lapicera, $lapiceraB);
    array_push($lapicera, $lapiceraC);

    foreach ( $lapicera as $key => $value ) {

        echo "Lapicera: <br>";

        foreach($value as $key2 => $value2) 
        {
            
            echo "$key2 : $value2<br>";
    
        }

        echo "<br>";

    }
    



?>