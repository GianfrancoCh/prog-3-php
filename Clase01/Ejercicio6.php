<!-- Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado. -->

<?php

$array_numeros = [5];

$array_numeros[0] = rand(-10,10);
$array_numeros[1] = rand(-10,10);
$array_numeros[2] = rand(-10,10);
$array_numeros[3] = rand(-10,10);
$array_numeros[4] = rand(-10,10);

$suma = 0;

for ($i = 0; $i < 5; $i++) {

    $suma += $array_numeros[$i];
}

echo "Promedio: ".$suma."<br>";

    
    if($suma < 6){

        echo "El promedio del array es menor a 6 ";
    }elseif($suma == 6){
        echo "El promedio del array es 6";
    }elseif($suma > 6){
        echo "El promedio del array es mayor a 6";
    }else{
        echo "ERROR";
    }
            
         
    


?>