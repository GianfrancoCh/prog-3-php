<?php

// Realizar el desarrollo de una función que reciba un Array de caracteres y 
// que invierta el orden
// de las letras del Array.
// Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.



function invertirPalabra($array){
    
    $len = strlen($array);
    $arrayInvertido = [];

    for($i = 0; $i < $len; $i++){
        $arrayInvertido[$i] = $array[$len-1- $i];
        
    }

    return $arrayInvertido;

}

$invertido = invertirPalabra("HOLA");

foreach($invertido as $letra){
    echo $letra;
}
