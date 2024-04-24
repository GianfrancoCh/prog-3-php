<?php

// Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
// distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
// año es. Utilizar una estructura selectiva múltiple.

    date_default_timezone_set('America/Argentina/Buenos_Aires');


    echo date("d/m/Y") . "<br>";
    echo date("D/M/y") . "<br>";

    
   $mes = date("m");
   $dia = date("d");

   switch ($mes) {
        case "1":
            echo "Estamos en verano";
        case "2":
            echo "Estamos en verano";
        case "3":
            if($date<"21")
            {
                echo "Estamos en verano";
            }
            else
            {
                echo "Estamos en otoño";
            } 
            break;
        case "4":
            echo "Estamos en otoño";
        case "5":
            echo "Estamos en otoño";
        case "6":
            if($date<"21")
            {
                echo "Estamos en otoño";
            }
            else
            {
                echo "Estamos en invierno";
            }
            break;
        case "7":
            echo "Estamos en invierno";
        case "8":
            echo "Estamos en invierno";
        case "9":
            if($date<"21")
            {
                echo "Estamos en invierno";
            }
            else
            {
                echo "Estamos en primavera";
            }
            break;
        case "10":
            echo "Estamos en primavera";
        case "11":
            echo "Estamos en primavera";
        case "12":    
            if($date<"21")
            {
                echo "Estamos en primavera";
            }
            else
            {
                echo "Estamos en verano";
            }
            break;
   }

