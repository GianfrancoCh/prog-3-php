<?php

require_once 'Auto.php';
class Garage{

    private $razonSocial;
    private $precioPorHora;

    private $autos = [];

    public function __construct($razonSocial, $precioPorHora = "", $autos = []){
        $this->razonSocial = $razonSocial;
        $this->precioPorHora = $precioPorHora; 
        $this->autos = $autos; 
       
    }

    public function MostrarGarage(){
        echo "</br>-Razon Social: " . $this->razonSocial."</br>";
        
        if($this->precioPorHora!=null){
            echo "Precio por hora: ". $this->precioPorHora."</br>";
        }

        if($this->autos!=null){

            echo "Autos en el garage: </br>";
            foreach($this->autos as $auto){
                Auto::MostrarAuto( $auto );
            }
        }
        
    }

    public function Equals($garage, $auto){

        if(in_array($auto, $garage->autos)){
            return true;
        }
        else{
            return false;
        }
    }

    public function Add($auto){

        if($this->Equals($this, $auto)){
            echo "<br> El auto ya esta en el garage <br>";
        }
        else{
            $this->autos[]=$auto;
            "Se agregó el auto";
        }

    }
    public function Remove($auto){

        if($this->Equals($this, $auto)){

            $index = array_search($auto,$this->autos);
            unset($this->autos[$index]);
        }
        else{
            
            echo "<br> El auto no esta en el garage <br>";
        }
    }

    public static function AltaGarage($razonSocial, $precioPorHora, $autos){

        $columnas = "$razonSocial,$precioPorHora,$autos";
        $archivo = fopen("garage.csv", "a");
        if($archivo){
            fputs($archivo,$columnas);
            fclose($archivo);
            echo "Se dio de alta un garage";
        }
        else{
            echo "Error";
        }
    }


}