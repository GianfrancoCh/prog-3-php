<?php

class Auto{

    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($_marca, $_color, $_precio = null,$_fecha = null){
        $this->_marca = $_marca;
        $this->color = $_color;  
    }

    public function AgregarImpuestos($doble){
        $this->_precio += $doble;
    } 

    public static function MostrarAuto($auto){
        echo "Marca: " . $auto->_marca."</br>";
        echo "Color: " . $auto->_color."</br>";
        echo "Precio: " . $auto->precio."</br>";
        echo "Fecha: " . $auto->_fecha."</br>";
    }

    public function Equals($auto_A,$auto_B){

        if($auto_A->_marca == $auto_B->_marca){
            return true;
        }
        else{
            return false;
        }
    }
}