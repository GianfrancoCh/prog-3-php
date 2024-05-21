<?php

include_once("Cupon.php");
class Devolucion{
    public $id;
    public $numeroPedido;
    public $causa;
    public $cupon;
    public $estado;

    //Constructor
    public function __construct($numeroPedido,$causa) {
        
        $this->id = $this->generarID();
        $this->numeroPedido = $numeroPedido;
        $this->causa = $causa;
      
    }

    private function generarID() {
        $filePath = 'devoluciones.json';
        $ventas = [];
        if (file_exists($filePath)) {
            $ventas = json_decode(file_get_contents($filePath), true);
        }

        do {
            $id = rand(1, 10000);
            $flagID = true;
            foreach ($ventas as $venta) {
                if ($venta['id'] == $id) {
                    $flagID = false;
                    break;
                }
            }
        } while (!$flagID);

        return $id;
    }

    public static function guardarDevolucionesJSON($devoluciones){
        
        $json = json_encode($devoluciones);
        file_put_contents("devoluciones.json", $json);
        echo "<p>Se guardó la devolucion en JSON</p>";
 
    }


    public static function leerDevolucionesJSON(){

        $devoluciones = [];
        if (file_exists("devoluciones.json")) {
            $contenido = file_get_contents("devoluciones.json");
            $devoluciones = json_decode($contenido, true);
            return $devoluciones;
        }
        else{
            return null;
        }  
    }

    public static function agregarDevolucion($devolucion) {
        $devoluciones = self::leerDevolucionesJSON();
        $devoluciones[] = [
            'id' => $devolucion->id,
            'numeroPedido' => $devolucion->numeroPedido,
            'causa' => $devolucion->causa,
        ];
        self::guardarDevolucionesJSON($devoluciones);
        $cupon = new Cupon($devolucion->id,10);
        Cupon::agregarCupon($cupon);
        echo "<p>Devolucion agregada</p>";
    }


}

