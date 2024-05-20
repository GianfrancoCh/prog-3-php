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

    public static function validarUsuario($idUsuario){

        $filePath = 'usuarios.json';
        $usuarios = [];
        if (file_exists($filePath)) {
            $usuarios = json_decode(file_get_contents($filePath), true);
            foreach ($usuarios as $usuario) {
                if ($usuario['id'] == $idUsuario){
                    return true;
                }
            }
        }
        return false;
    }

    public static function validarProducto($codigoBarra){

        $filePath = 'productos.json';
        $productos = [];
        if (file_exists($filePath)) {
            $productos = json_decode(file_get_contents($filePath), true);
            foreach ($productos as $producto) {
                if ($producto['codigobarra'] == $codigoBarra){
                    return true;
                }
            }
        }
        return false;
    }

    public static function validarStock($cantidad){

        $filePath = 'productos.json';
        $productos = [];
        if (file_exists($filePath)) {
            $productos = json_decode(file_get_contents($filePath), true);
            foreach ($productos as $producto) {
                if ($producto['stock'] >= $cantidad){
                    return true;
                }
            }
        }
        return false;
    }
    public static function validarVenta($codigoBarra,$idUsuario,$cantidad){

        if(self::validarUsuario($idUsuario) && self::validarProducto($codigoBarra) && self::validarStock($cantidad)){
            return true;


        }

    }
    

}