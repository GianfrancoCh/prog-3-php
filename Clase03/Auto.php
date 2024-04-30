<?php

class Auto{

    private $color;
    private $precio;
    private $marca;
    private $fecha;

    public function __construct($marca, $color, $precio = "",$fecha = ""){
        $this->marca = $marca;
        $this->color = $color; 
        $this->precio = $precio;
        $this->fecha = $fecha;
    }

    public function AgregarImpuestos($doble){
        $this->precio += $doble;
    } 

    public static function MostrarAuto($auto){
    
        echo "</br> Marca: " . $auto->marca."</br>";
        echo "Color: " . $auto->color."</br>";

        if($auto->precio != null){
            echo "Precio: " . $auto->precio."</br>";
        }
        if($auto->fecha != null){
            echo "Fecha: " . $auto->fecha->format('d-m-Y')."</br>";
        }
   
    }

    public function Equals($auto_A,$auto_B){

        if($auto_A->marca == $auto_B->marca){
            return true;
        }
        else{
            return false;
        }
    }

    public static function Add($auto_A, $auto_B){   
        if($auto_A->marca == $auto_B->marca && $auto_A->color == $auto_B->color){
            return $auto_A->precio + $auto_B->precio;
        }
        else{

            echo "</br>No se pudo sumar</br>";
        }

    }


    public static function AltaAuto($marca, $color, $precio = "",$fecha =""){

        $columnas = "$marca,$color,$precio,$fecha\n";
        $archivo = fopen("autos.csv", "a");
        if($archivo){
            fputs($archivo,$columnas);
            fclose($archivo);
            echo "Se agrego auto";
        }
        else{
            echo "Error";
        }
    }


    
    
}
