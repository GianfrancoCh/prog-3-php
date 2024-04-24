<!-- Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach. -->

<?php

    $array_impares = [];

    $contador = 10;

    for ($i = 0; $i < 10; $i++){

        if($contador %2!=0){
            $array_impares[] = $contador;
        }

        $contador--;
    }

    foreach($array_impares as $num_impar){

        echo "$num_impar </br>";
    }

    $len = count($array_impares);

    while($len > 0){

        echo $array_impares[$len-1]."</br>";
        $len--;
    }


?>