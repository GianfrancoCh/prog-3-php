<?php

class Producto{
    public $codigoBarra;
    public $nombre;

    public $tipo;

    public $stock;

    public $precio;

    //Constructor
    public function __construct($codigoBarra, $nombre, $tipo, $stock, $precio) {
        $this->id = $this->generarID();
        
        if (!$this->setCodigoBarra($codigoBarra) || 
        !$this->setNombre($nombre) || 
        !$this->setTipo($tipo) || 
        !$this->setStock($stock) || 
        !$this->setPrecio($precio)) {

            echo "Datos inválidos proporcionados.";
        }

    }

    public function setCodigoBarra($codigoBarra){
        if (strlen($codigoBarra) != 6 || !is_numeric($codigoBarra)) {
            echo "Codigo de barra invalido.";
            return false;      
        }
        $this->codigoBarra = $codigoBarra;
        return true;
    }

    public function setNombre($nombre) {

        if (empty($nombre)) {
            echo "Nombre inválido";
            return false;
        }
        $this->nombre = $nombre;
        return true;
    }

    public function setTipo($tipo) {
        if (empty($tipo)) {
            echo "Tipo inválido";
            return false;
        }
        $this->tipo = $tipo;
        return true;
    }

    public function setStock($stock) {
        if (!is_numeric($stock) || $stock < 0) {
            echo "Stock inválido";
            return false;
        }
        $this->stock = $stock;
        return true;
    }

    public function setPrecio($precio) {
        if (!is_numeric($precio) || $precio < 0) {
            echo "Precio inválido";
            return false;
        }
        $this->precio = $precio;
        return true;
    }
    private function generarID() {
        $filePath = 'productos.json';
        $usuarios = [];
        if (file_exists($filePath)) {
            $usuarios = json_decode(file_get_contents($filePath), true);
        }

        do {
            $id = rand(1, 10000);
            $flagID = true;
            foreach ($usuarios as $usuario) {
                if ($usuario['id'] == $id) {
                    $flagID = false;
                    break;
                }
            }
        } while (!$flagID);

        return $id;
    }


    public static function guardarProductosJSON($productos){
        
        $json = json_encode($productos);
        file_put_contents("productos.json", $json);
        echo "<p>Se guardó el producto en JSON</p>";
    
        
    }

    public static function actualizarProducto($codigoBarra, $nuevoStock){

        $productos = self::leerProductosJSON();
        foreach($productos as $key => $producto){
            if ($producto['codigobarra'] == $codigoBarra) {
                $productos[$key]['stock'] += $nuevoStock; // Actualizamos el stock del producto
                $productoActualizado = true;
                break;
            }
        }

        if ($productoActualizado) {
            self::guardarProductosJSON($productos); // Guardamos el array modificado de nuevo en el JSON
            return "Actualizado";
        }


        return "No se pudo actualizar";
    }


    public static function leerProductosJSON(){

        $productos = [];
        if (file_exists("productos.json")) {
            $contenido = file_get_contents("productos.json");
            $productos = json_decode($contenido, true);
            return $productos;
        }
        else{
            return null;
        }  
    }

    public static function buscarProductoExistente($codigoBarra){

        $productos = self::leerProductosJSON();
        if($productos != null){
            foreach ($productos as $producto) {
                if ($producto['codigobarra'] == $codigoBarra) {
                    return $productos;
                }
            }
        }  
        return null;  
    }

    public static function agregarProducto($producto) {
        $productos = self::leerProductosJSON();
        $productos[] = [
            'id' => $producto->id,
            'codigobarra' => $producto->codigoBarra,
            'nombre' => $producto->nombre,
            'tipo' => $producto->tipo,
            'stock' => $producto->stock,
            'precio' => $producto->precio
        ];
        self::guardarProductosJSON($productos);
        echo "<p>Ingresado</p>";
    }
}

