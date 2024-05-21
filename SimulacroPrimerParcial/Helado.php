<?php

class Helado{
    public $id;
    public $sabor;
    public $precio;

    public $tipo;

    public $vaso;

    public $cucurucho;

    //Constructor
    public function __construct($sabor, $precio, $tipo, $vaso, $stock) {
        
        
        if (!$this->setSabor($sabor) || 
        !$this->setPrecio($precio) || 
        !$this->setTipo($tipo) || 
        !$this->setVaso($vaso) ||  
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

    public function setSabor($sabor){
        if (empty($sabor)) {
            echo "Sabor inválido";
            return false;
        }
        $this->sabor = $sabor;
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
    public function setTipo($tipo) {
        if (empty($tipo) || ($tipo != "crema" && $tipo != "agua")) {
            echo "Tipo inválido";
            return false;
        }
        $this->tipo = $tipo;
        return true;
    }
    public function setVaso($vaso) {

        if (empty($vaso) || ($vaso != "cucurucho" && $vaso != "vaso")) {
            echo "Vaso inválido";
            return false;
        }
        $this->vaso = $vaso;
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
        $filePath = 'helados.json';
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

    public static function subirImagen($imagen, $sabor, $tipo){

        $carpeta_archivos = 'ImagenesDeHelados/2024/';

        // Datos del arhivo enviado por POST
        $nombre_archivo = $sabor . "+" . $tipo;
        $tipo_archivo = $_FILES['imagen']['type'];
        $tamano_archivo = $_FILES['imagen']['size'];

        // Ruta destino, carpeta + nombre del archivo que quiero guardar
        $extension_archivo = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $ruta_destino = $carpeta_archivos . $nombre_archivo . "." . $extension_archivo;

        // Realizamos las validaciones del archivo
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


    public static function guardarProductosJSON($productos){
        
        $json = json_encode($productos);
        file_put_contents("helados.json", $json);
        echo "<p>Actualizado JSON helados</p>";
 
    }

    public static function actualizarProducto($sabor, $tipo, $nuevoStock){

        $productos = self::leerProductosJSON();
        foreach($productos as $key => $producto){
            if ($producto['sabor'] == $sabor && $producto['tipo'] == $tipo) {
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
        if (file_exists("helados.json")) {
            $contenido = file_get_contents("helados.json");
            $productos = json_decode($contenido, true);
            return $productos;
        }
        else{
            return null;
        }  
    }

    public static function buscarProductoExistente($sabor, $tipo){

        $productos = self::leerProductosJSON();
        if($productos != null){
            foreach ($productos as $producto) {
                if ($producto['sabor'] == $sabor && $producto['tipo'] == $tipo) {
                    return $producto;
                }
            }
        }  
        return null;  
    }

    public static function validarStock($sabor, $tipo, $stock){
        $productos = self::leerProductosJSON();
        if($productos != null){
            foreach ($productos as $producto) {
                if ($producto['sabor'] == $sabor && $producto['tipo'] == $tipo && $producto['stock']>=$stock) {
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
            'sabor' => $producto->sabor,
            'precio' => $producto->precio,
            'tipo' => $producto->tipo,
            'vaso' => $producto->vaso,
            'stock' => $producto->stock
        ];
        self::guardarProductosJSON($productos);
        echo "<p>Ingresado</p>";
    }
}

