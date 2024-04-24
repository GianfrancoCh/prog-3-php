<?php

// Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
// por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
// entre el 20 y el 60.
// Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.

$num = 59;

if($num>=20 && $num<=29){
    if($num==20)
    {
        echo "Veinte";
    }
    else{
        $aux = $num - 20;
        $palabra = "veinti";
        switch($aux)
        {
            case 1:
                echo $palabra." uno";
                break;
            case 2:
                echo $palabra." dos";
                break;
            case 3:
                echo $palabra." tres";
                break;
            case 4:
                echo $palabra." cuatro";
                break;
            case 5:
                echo $palabra." cinco";
                break;
            case 6:
                echo $palabra." seis";
                break;
            case 7:
                echo $palabra." siete";
                break;
            case 8:
                echo $palabra." ocho";
                break;
            case 9:
                echo $palabra." nueve";
                break;
                                
        }

    }
   
}
elseif($num>= 30 && $num<= 39){
    
    $aux = $num - 30;
    $palabra = "treinta";
    switch($aux)
    {
        case 0:
            echo $palabra;
            break;
        case 1:
            echo $palabra." y uno";
            break;
        case 2:
            echo $palabra." y dos";
            break;
        case 3:
            echo $palabra." y tres";
            break;
        case 4:
            echo $palabra." y cuatro";
            break;
        case 5:
            echo $palabra." y cinco";
            break;
        case 6:
            echo $palabra." y seis";
            break;
        case 7:
            echo $palabra." y siete";
            break;
        case 8:
            echo $palabra." y ocho";
            break;
        case 9:
            echo $palabra." y nueve";
            break;
                            
    }
    
}elseif($num>= 40 && $num<= 49){
    
    $aux = $num - 40;
    $palabra = "cuarenta";
    switch($aux)
    {
        case 0:
            echo $palabra;
            break;
        case 1:
            echo $palabra." y uno";
            break;
        case 2:
            echo $palabra." y dos";
            break;
        case 3:
            echo $palabra." y tres";
            break;
        case 4:
            echo $palabra." y cuatro";
            break;
        case 5:
            echo $palabra." y cinco";
            break;
        case 6:
            echo $palabra." y seis";
            break;
        case 7:
            echo $palabra." y siete";
            break;
        case 8:
            echo $palabra." y ocho";
            break;
        case 9:
            echo $palabra." y nueve";
            break;
                            
    }
    
}elseif($num>= 50 && $num<= 59){
    
    $aux = $num - 50;
    $palabra = "cincuenta";
    switch($aux)
    {
        case 0:
            echo $palabra;
            break;
        case 1:
            echo $palabra." y uno";
            break;
        case 2:
            echo $palabra." y dos";
            break;
        case 3:
            echo $palabra." y tres";
            break;
        case 4:
            echo $palabra." y cuatro";
            break;
        case 5:
            echo $palabra." y cinco";
            break;
        case 6:
            echo $palabra." y seis";
            break;
        case 7:
            echo $palabra." y siete";
            break;
        case 8:
            echo $palabra." y ocho";
            break;
        case 9:
            echo $palabra." y nueve";
            break;
                            
    }
}
elseif($num= 60){

    echo "sesenta";
    
}

