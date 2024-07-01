<?php

class Conjunto{
    public $id;
    public $marca_impresora;
    public $marca_cartucho;

    public $modelo_impresora;

    public $modelo_cartucho;

    public $precio;

    public $tipo;

    //Constructor
    public function __construct($marca_impresora, $marca_cartucho, $modelo_impresora, $modelo_cartucho, $precio, $tipo) {
        
       $this->id = $this->generarID();
       $this->marca_impresora = $marca_impresora;
       $this->marca_cartucho = $marca_cartucho;
       $this->modelo_impresora = $modelo_impresora;
       $this->modelo_cartucho = $modelo_cartucho;
       $this->precio = $precio;
       $this->tipo = $tipo;

    }

    public function esValido(){
        return $this->id !== false;
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

    

    public static function agregarConjunto($conjunto) {
        $productos = Producto::leerProductosJSON();
        $productos[] = [
            'id' => $conjunto->id,
            'marcaImpresora' => $conjunto->marca_impresora,
            'marcaCartucho' => $conjunto->marca_cartucho,
            'modeloImpresora' => $conjunto->modelo_impresora,
            'modeloCartucho' => $conjunto->modelo_cartucho,
            'precio' => $conjunto->precio,
            'tipo' => $conjunto->tipo
        ];
        Producto::guardarProductosJSON($productos);
        echo "<p>Ingresado</p>";
    }

    public static function subirImagen($imagen, $modeloImpresora, $modeloCartucho){

        $carpeta_archivos = 'ImagenesDeConjuntos/2024/';

        // Datos del arhivo enviado por POST
        $nombre_archivo = $modeloImpresora . "+" . $modeloCartucho;
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



  
    
}

