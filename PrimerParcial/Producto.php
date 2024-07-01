<?php

class Producto{
    public $id;
    public $marca;
    public $precio;

    public $tipo;

    public $modelo;

    public $color;

    public $stock;

    //Constructor
    public function __construct($marca, $precio, $tipo, $modelo, $color, $stock) {
        
        
        if (!$this->setMarca($marca) || 
        !$this->setPrecio($precio) || 
        !$this->setTipo($tipo) || 
        !$this->setModelo($modelo) || 
        !$this->setColor($color)||
        !$this->setStock($stock)){
            $this->id = false;
           echo "Datos inválidos proporcionados.";    
        }else{

            $this->id = $this->generarID();
        }

    }

    public function esValido(){
        return $this->id !== false;
    }

    public function setMarca($marca){
        if (empty($marca)) {
            echo "Marca invalida";
            return false;
        }
        $this->marca = $marca;
        return true;
    }
    public function setPrecio($precio) {
        if (!is_numeric($precio) || $precio < 0) {
            echo "Precio invalido";
            return false;
        }
        $this->precio = $precio;
        return true;
    }
    public function setTipo($tipo) {
        if (empty($tipo) || ($tipo != "impresora" && $tipo != "cartucho")) {
            echo "Tipo invalido";
            return false;
        }
        $this->tipo = $tipo;
        return true;
    }
    public function setModelo($modelo) {

        if (empty($modelo)) {
            echo "Modelo invalido";
            return false;
        }
        $this->modelo = $modelo;
        return true;
    }

    public function setColor($color) {

        if (empty($color)) {
            echo "Color invalido";
            return false;
        }
        $this->color = $color;
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

    private function generarID() {
        $filePath = 'tienda.json';
        $productos = [];
        if (file_exists($filePath)) {
            $productos = json_decode(file_get_contents($filePath), true);
        }

        do {
            $id = rand(1, 10000);
            $flagID = true;
            foreach ($productos as $producto) {
                if ($producto['id'] == $id) {
                    $flagID = false;
                    break;
                }
            }
        } while (!$flagID);

        return $id;
    }

    public static function guardarProductosJSON($productos){
        
        $json = json_encode($productos);
        file_put_contents("tienda.json", $json);
        echo "<p>Guardado JSON productos</p>";
 
    }

    public static function actualizarProductoPrecio($marca, $tipo, $nuevoStock , $nuevoPrecio){

        $productos = self::leerProductosJSON();
        $productoActualizado = false;
        foreach($productos as $key => $producto){
            if ($producto['marca'] == $marca && $producto['tipo'] == $tipo) {
                $productos[$key]['stock'] += $nuevoStock; 
                $productos[$key]['precio'] = $nuevoPrecio;
                $productoActualizado = true;
                break;
            }
        }

        if ($productoActualizado) {
            self::guardarProductosJSON($productos);
            return "Actualizado";
        }
        return "No se pudo actualizar";
    }


    public static function actualizarProductoVenta($marca, $tipo, $nuevoStock){

        $productos = self::leerProductosJSON();
        $productoActualizado = false;
        foreach($productos as $key => $producto){
            if ($producto['marca'] == $marca && $producto['tipo'] == $tipo) {
                $productos[$key]['stock'] += $nuevoStock; 
                $productoActualizado = true;
                break;
            }
        }

        if ($productoActualizado) {
            self::guardarProductosJSON($productos);
            return "Actualizado";
        }else{

            return "No se pudo actualizar";
        }
    }


    public static function leerProductosJSON(){

        $productos = [];
        if (file_exists("tienda.json")) {
            $contenido = file_get_contents("tienda.json");
            $productos = json_decode($contenido, true);
            return $productos;
        }
        else{
            return null;
        }  
    }

    public static function buscarProductoExistente($marca, $tipo){

        $productos = self::leerProductosJSON();
        if($productos != null){
            foreach ($productos as $producto) {
                if ($producto['marca'] == $marca && $producto['tipo'] == $tipo) {
                    return $producto;
                }
            }
        }  
        return null;  
    }

    public static function consultarProductoEspecifico($marca, $tipo, $color) {
        $flagMarca = false;
        $flagTipo = false;
        $flagColor = false;
    
        $productos = self::leerProductosJSON();
        if ($productos != null) {
            foreach ($productos as $producto) {
                if ($producto['marca'] == $marca) {
                    $flagMarca = true;
                    if ($producto['tipo'] == $tipo) {
                        $flagTipo = true;
                        if ($producto['color'] == $color) {
                            $flagColor = true;
                            break;  
                        }
                    }
                }
            }
        }
    
        if ($flagMarca && $flagTipo && $flagColor) {
            echo "Existe un producto con la marca '$marca', tipo '$tipo' y color '$color'.";
        } else {
            if (!$flagMarca) {
                echo "No hay productos de marca '$marca'.\n";
            } else if (!$flagTipo) {
                echo "No hay productos de tipo '$tipo' para la marca '$marca'.\n";
            } else if (!$flagColor) {
                echo "No hay productos de color '$color' para la marca '$marca' y tipo '$tipo'.\n";
            }
        }
    }

    public static function agregarProducto($producto) {
        $productos = self::leerProductosJSON();
        $productos[] = [
            'id' => $producto->id,
            'marca' => $producto->marca,
            'precio' => $producto->precio,
            'tipo' => $producto->tipo,
            'modelo' => $producto->modelo,
            'color' => $producto->color,
            'stock' => $producto->stock
        ];
        self::guardarProductosJSON($productos);
        echo "<p>Ingresado</p>";
    }

    public static function subirImagen($imagen, $modelo, $tipo){

        $carpeta_archivos = 'ImagenesDeProductos/2024/';

        $nombre_archivo = $modelo . "+" . $tipo;
        $tipo_archivo = $_FILES['imagen']['type'];
        $tamano_archivo = $_FILES['imagen']['size'];

        $extension_archivo = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $ruta_destino = $carpeta_archivos . $nombre_archivo . "." . $extension_archivo;

        if (!((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 300000))) {
            echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .png o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
        }else{
            if (move_uploaded_file($_FILES['imagen']['tmp_name'],  $ruta_destino)){
                    echo "El archivo ha sido cargado correctamente.";
            }else{
                    echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }
        }
    }

    public static function validarStock($marca,$tipo,$modelo,$color,$stock){
        $productos = self::leerProductosJSON();
        if($productos != null){
            foreach ($productos as $producto) {
                if ($producto['marca'] == $marca && $producto['tipo'] == $tipo && $producto['modelo'] == $modelo && $producto['color'] == $color && $producto['stock']>=$stock) {
                    return $producto;
                }
            }
        }  
        return null;  
    }



    public static function obtenerPrecioProducto($marca, $tipo, $modelo, $color){
        $productos = self::leerProductosJSON();
        if($productos != null){
            foreach ($productos as $producto) {
                if ($producto['marca'] == $marca && $producto['tipo'] == $tipo && $producto['modelo'] == $modelo && $producto["color"]==$color) {
                    return $producto['precio'];
                }
            }
        }  
        return null;  
    }

    public static function validarMarcaModeloTipo($marca,$modelo,$tipo){
        $productos = self::leerProductosJSON();
        if($productos != null){
            foreach ($productos as $producto) {
                if($producto['tipo'] == $tipo){
                    if ($producto['marca'] == $marca  && $producto['modelo'] == $modelo) {
                        return $producto;
                    }
                }
              
            }
        }  
        return null;  
    }

    public static function consultarProductosPrecio($precio, $precio2) {

        $productos = Producto::leerProductosJSON();
        $productosPrecio = [];
        foreach ($productos as $producto) {
            if($producto['tipo'] == 'impresora' || $producto['tipo'] == 'cartucho'){
                if ($producto['precio'] >= $precio && $producto['precio'] <= $precio2) {
                    $productosPrecio[] = $producto;
                }
            }
            
        }
        return $productosPrecio;
    }


    
}

