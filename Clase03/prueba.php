<?php 


$archivo = fopen("usuarios.csv", "r");


        

    while(!feof($archivo)){
        $linea = fgets($archivo);
        $elementosDeLaLinea = explode(",", $linea);
        echo $elementosDeLaLinea[2];
        
    }
    
fclose($archivo);