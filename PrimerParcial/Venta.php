<?php

class Venta{
    public $id;
    public $numeroPedido;
    public $usuario;
    public $fecha;
    public $cantidad;
    public $marca; 
    public $tipo;
    public $modelo;

    public $color;

    public $precio;
    //Constructor
    public function __construct($numeroPedido,$usuario, $cantidad, $marca, $tipo, $modelo, $color,$precio) {
        
        $this->id = $this->generarID();
        $this->numeroPedido = $numeroPedido;
        $this->fecha = date("d-m-Y");
        $this->usuario = $usuario; 
        $this->cantidad = $cantidad;
        $this->marca = $marca;
        $this->tipo = $tipo;
        $this->modelo = $modelo;
        $this->color = $color;
        //modifique despues de entrega
        $this->precio = $precio;
        
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
            foreach ($ventas as $venta) {
                if ($venta['id'] == $id) {
                    $flagID = false;
                    break;
                }
            }
        } while (!$flagID);

        return $id;
    }

    public static function guardarVentasJSON($ventas){
        
        $json = json_encode($ventas);
        file_put_contents("ventas.json", $json);
        echo "<p>Se guardo la venta en JSON</p>";
 
    }
    public static function leerVentasJSON(){

        $ventas = [];
        if (file_exists("ventas.json")) {
            $contenido = file_get_contents("ventas.json");
            $ventas = json_decode($contenido, true);
            return $ventas;
        }
        else{
            return null;
        }  
    }

    public static function agregarVenta($venta) {
        $ventas = self::leerVentasJSON();
        $ventas[] = [
            'id' => $venta->id,
            'numeroPedido' => $venta->numeroPedido,
            'fecha' => $venta->fecha,
            'usuario' => $venta->usuario,
            'cantidad' => $venta->cantidad,
            'marca' => $venta->marca,
            'tipo' => $venta->tipo,
            'modelo' => $venta->modelo,
            'color' => $venta->color,
            'precio' => $venta->precio

        ];
        Producto::actualizarProductoVenta($venta->marca, $venta->tipo, -$venta->cantidad);
        self::guardarVentasJSON($ventas);
        echo "<p>Venta agregada</p>";
    }

    public static function subirImagen($imagen, $marca, $tipo, $modelo, $usuario){

        $carpeta_archivos = 'ImagenesDeVenta/2024/';
        $usuario = explode("@", $usuario);
        // Datos del arhivo enviado por POST
        $nombre_archivo = $marca . "+" . $tipo. "+" . $modelo . "+" . $usuario[0];
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

    public static function moverImagenBackup($imagenNombre, $rutaOriginal) {

        $carpetaBackup = 'ImagenesBackupVentas/2024/';
        if (!file_exists($carpetaBackup)) {
            mkdir($carpetaBackup, 0777, true);  // Asegura que la carpeta exista
        }

        $rutaDestino = $carpetaBackup . $imagenNombre;

        // Intenta mover el archivo
        if (file_exists($rutaOriginal)) {
            if (rename($rutaOriginal, $rutaDestino)) {
                echo "La imagen ha sido movida a backup correctamente.";
            } else {
                echo "Ocurrió algún error al mover la imagen. No pudo guardarse en backup.";
            }
        } else {
            echo "No se encontró la imagen original.";
        }
    }


    public static function consultarVentasPorFecha($fecha=null) {
        $ventas = self::leerVentasJSON();
        $totalUnidades = 0;
    
        foreach ($ventas as $venta) {
            // Asegurar que la fecha de la venta sea comparada correctamente
            if (date('d-m-Y', strtotime($venta['fecha'])) === $fecha) {
                $totalUnidades += (int) $venta['cantidad'];
            }
        }
        return $totalUnidades;
    }

   
    
    public static function consultarVentasPorUsuario($usuario) {
        $ventas = self::leerVentasJSON();
        $ventasUsuario = [];
        foreach ($ventas as $venta) {
            if ($venta['usuario'] === $usuario) {
                $ventasUsuario[] = $venta;
            }
        }
        return $ventasUsuario;
    }

    public static function consultarVentasPorTipo($tipo) {
        $ventas = self::leerVentasJSON();
        $ventasTipo = [];
        foreach ($ventas as $venta) {
            if ($venta['tipo'] === $tipo) {
                $ventasTipo[] = $venta;
            }
        }
        return $ventasTipo;
    }

    public static function consultarIngresos($fecha = null) {
        $ventas = self::leerVentasJSON();
        $ingresos = 0;
        if($fecha == ''){
            foreach ($ventas as $venta) {
                $ingresos += $venta["precio"] * $venta["cantidad"];
            }
        }else{
            foreach ($ventas as $venta) {
                if ($venta['fecha'] === $fecha) {
                    $ingresos += $venta["precio"] * $venta["cantidad"];
                }
            }
        }
    
        return $ingresos;
    }


    public static function consultarProductoMasVendido() {
        $ventas = self::leerVentasJSON();
        $conteoProductos = [];

        foreach ($ventas as $venta) {
            $clave = $venta['marca'] . '_' . $venta['tipo'] . '_' . $venta['modelo'] . '_' . $venta['color'];
            if (!isset($conteoProductos[$clave])) {
                $conteoProductos[$clave] = 0;
            }
            $conteoProductos[$clave] += $venta['cantidad'];
        }

        $maxCantidad = 0;
        $productoMasVendido = null;
        foreach ($conteoProductos as $key => $cantidad) {
            if ($cantidad > $maxCantidad) {
                $maxCantidad = $cantidad;
                $productoMasVendido = $key;
            }
        }

        if ($productoMasVendido) {
            list($marca, $tipo, $modelo, $color) = explode('_', $productoMasVendido);
            return [
                'marca' => $marca,
                'tipo' => $tipo,
                'modelo' => $modelo,
                'color' => $color,
                'cantidad' => $maxCantidad
            ];
        }
        return null;
    }


    public static function validarVenta($numeroPedido, $usuario, $marca, $tipo, $modelo, $cantidad){
        $ventas = self::leerVentasJSON();
        if($ventas != null){
            foreach ($ventas as $venta) {
                if ($venta['numeroPedido'] == $numeroPedido && $venta['usuario'] == $usuario && $venta['marca']==$marca && $venta['tipo']==$tipo && $venta['modelo']==$modelo && $venta['cantidad']==$cantidad) {
                    return $venta;
                }
            }
        }  
        return null;  
    }

    public static function modificarVenta($numeroPedido, $nuevaFecha){

        $ventas = self::leerVentasJSON();
        $productoActualizado = false;
        foreach($ventas as $key => $venta){
            if ($venta['numeroPedido'] == $numeroPedido) {
                $ventas[$key]['fecha'] = $nuevaFecha; 
                $productoActualizado = true;
                break;
            }
        }

        if ($productoActualizado) {
            self::guardarVentasJSON($ventas); 
            return "Actualizado";
        }
        return "No se pudo actualizar";
    }

    public static function validarVentaNumeroPedido($numeroPedido){
        $ventas = self::leerVentasJSON();
        if($ventas != null){
            foreach ($ventas as $venta) {
                if ($venta['numeroPedido'] == $numeroPedido) {
                    return $venta;
                }
            }
        }  
        return null;  
    }

    public static function borrarVenta($numeroPedido) {
        $ventas = self::leerVentasJSON();

        foreach ($ventas as $key => $venta) {
            if ($venta['numeroPedido'] == $numeroPedido) {
                $ventas[$key]['eliminado'] = true;
                $usuario = $venta['usuario'];
                $usuario = explode("@", $usuario);
                $nombreImagen = $venta['marca']."+".$venta['tipo']."+".$venta['modelo']."+".$usuario[0].".jpg";
                $ruta = "ImagenesDeVenta/2024/".$nombreImagen;

                self::moverImagenBackup($nombreImagen,$ruta);
                break;
            }
        }

        self::guardarVentasJSON($ventas);
        echo "<br>Venta estado eliminado<br>";
    
    }

}

