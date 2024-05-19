<?php

class Venta{
    public $codigoBarra;
    public $nombre;

    public $tipo;

    public $stock;

    public $precio;

    //Constructor
    public function __construct($codigoBarra, $idUsuario, $cantidad) {
        $this->id = $this->generarID();
        $this->codigoBarra = $codigoBarra;
        $this->idUsuario = $idUsuario;
        $this->cantidad = $cantidad;    
    }


    private function generarID() {
        $filePath = 'ventas.json';
        $ventas = [];
        if (file_exists($filePath)) {
            $ventas = json_decode(file_get_contents($filePath), true);
        }

        do {
            $id = rand(1, 10000);
            $flagID = true;
            foreach ($ventas as $usuario) {
                if ($usuario['id'] == $id) {
                    $flagID = false;
                    break;
                }
            }
        } while (!$flagID);

        return $id;
    }

    public static function verificarProductoUsuario($codigoBarra,$idUsuario){
        
    }




}