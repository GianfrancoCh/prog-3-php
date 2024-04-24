<!--Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.-->

<?php

    $lapicera = array();
    $lapicera["A"] = array("color" => "azul", "marca"=>"BIC", "trazo"=>"fino","precio"=>100);
    $lapicera["B"] = array("color" => "negra", "marca"=>"Maped", "trazo"=>"grueso","precio"=>70);
    $lapicera["C"] = array("color" => "roja", "marca"=>"Faber-Castell", "trazo"=>"medio","precio"=>110);

    foreach ( $lapicera as $key => $value ) {

        echo "Lapicera: $key <br>";

        foreach($value as $key2 => $value2) 
        {
            
            echo "$key2 : $value2<br>";
    
        }

        echo "<br>";
    }

    $lapicera_index[0] = array("color" => "azul", "marca"=>"BIC", "trazo"=>"fino","precio"=>100);
    $lapicera_index[1] = array("color" => "negra", "marca"=>"Maped", "trazo"=>"grueso","precio"=>70);
    $lapicera_index[2] = array("color" => "roja", "marca"=>"Faber-Castell", "trazo"=>"medio","precio"=>110);

    foreach ( $lapicera_index as $key => $value ) {

        echo "Lapicera: $key <br>";
    
        foreach($value as $key2 => $value2) 
        {
                
            echo "$key2 : $value2<br>";
        
        }
    
        echo "<br>";
    }   


?>