<?php

class Cupon{
    public $id;
    public $devolucion_id;
    public $porcentajeDescuento;
    public $estado;

    //Constructor
    public function __construct($devolucion_id,$porcentajeDescuento) {
        
        $this->id = $this->generarID();
        $this->devolucion_id = $devolucion_id;
        $this->porcentajeDescuento = $porcentajeDescuento;
      
    }

    private function generarID() {
        $filePath = 'cupones.json';
        $cupones = [];
        if (file_exists($filePath)) {
            $cupones = json_decode(file_get_contents($filePath), true);
        }

        do {
            $id = rand(1, 10000);
            $flagID = true;
            foreach ($cupones as $cupon) {
                if ($cupon['id'] == $id) {
                    $flagID = false;
                    break;
                }
            }
        } while (!$flagID);

        return $id;
    }

    public static function guardarCuponesJSON($cupones){
        
        $json = json_encode($cupones);
        file_put_contents("cupones.json", $json);
        echo "<p>Se guardó el cupon en JSON</p>";
 
    }


    public static function leerCuponesJSON(){

        $cupones = [];
        if (file_exists("cupones.json")) {
            $contenido = file_get_contents("cupones.json");
            $cupones = json_decode($contenido, true);
            return $cupones;
        }
        else{
            return null;
        }  
    }

    public static function agregarCupon($cupon) {
        $cupones = self::leerCuponesJSON();
        $cupones[] = [
            'id' => $cupon->id,
            'devolucion_id' => $cupon->devolucion_id,
            'descuento' => $cupon->porcentajeDescuento,
            'estado' => "no usado",
        ];
        self::guardarCuponesJSON($cupones);
        echo "<p>Cupon agregada</p>";
    }


}

