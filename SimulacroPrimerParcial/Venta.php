<?php

class Venta{
    public $id;
    public $numeroPedido;
    public $usuario;
    public $fecha;
    public $cantidad;
    public $sabor; 
    public $tipo;
    public $vaso;

    //Constructor
    public function __construct($numeroPedido,$usuario, $cantidad, $sabor, $tipo, $vaso) {
        
        $this->id = $this->generarID();
        $this->numeroPedido = $numeroPedido;
        $this->fecha = date("d-m-Y");
        $this->usuario = $usuario; 
        $this->cantidad = $cantidad;
        $this->sabor = $sabor;
        $this->tipo = $tipo;
        $this->vaso = $vaso;
        
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
        echo "<p>Se guardó la venta en JSON</p>";
 
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
            'sabor' => $venta->sabor,
            'tipo' => $venta->tipo,
            'vaso' => $venta->vaso
        ];
        Helado::actualizarProducto($venta->sabor, $venta->tipo, -$venta->cantidad);
        self::guardarVentasJSON($ventas);
        echo "<p>Venta agregada</p>";
    }

    public static function subirImagen($imagen, $sabor, $tipo, $vaso, $usuario){

        $carpeta_archivos = 'ImagenesDeLaVenta/2024/';
        $usuario = explode("@", $usuario);
        // Datos del arhivo enviado por POST
        $nombre_archivo = $sabor . "+" . $tipo. "+" . $vaso . "+" . $usuario[0];
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

    public static function moverImagen($numeroPedido){
        $carpeta_archivos = 'ImagenesDeLaVenta/2024/';
        $carpeta_final = 'ImagenesBackupVentas/2024/';
        $venta = self::validarVentaNumeroPedido($numeroPedido);
        $usuario = explode("@", $venta["usuario"]);
        $nombre_archivo = $venta["sabor"] . "+" . $venta["tipo"]. "+" . $venta["vaso"] . "+" . $usuario[0] . ".png";
        $ruta_archivo = $carpeta_archivos . $nombre_archivo;
        $ruta_destino = $carpeta_final . $nombre_archivo;

        if(rename($ruta_archivo, $ruta_destino)){
            echo "se movio la imagen";
        }else{
            echo "no se movio la imagen";
        }

    }

    public static function consultarVentasPorFecha($fecha) {
        $ventas = self::leerVentasJSON();
        $cantidad = 0;
        foreach ($ventas as $venta) {
            if ($venta['fecha'] === $fecha) {
                $cantidad += $venta['cantidad'];
            }
        }
        return $cantidad;
    }

    public static function consultarVentasPorFechas($fecha1, $fecha2) {

        $ventas = self::leerVentasJSON();
        $ventasFechas = [];
        foreach ($ventas as $venta) {
            if ($venta['fecha'] >= $fecha1 && $venta['fecha'] <= $fecha2) {
                $ventasFechas[] = $venta;
            }
        }

        $sabores = [];
        foreach ($ventasFechas as $key => $venta) {
            $sabores[$key] = $venta['sabor'];
        }
        asort($sabores);
        $ventasOrdenadas = [];
        foreach ($sabores as $key => $sabor) {
            $ventasOrdenadas[] = $ventasFechas[$key];
        }
        return $ventasOrdenadas;
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

    public static function consultarVentasPorSabor($sabor) {
        $ventas = self::leerVentasJSON();
        $ventasSabor = [];
        foreach ($ventas as $venta) {
            if ($venta['sabor'] === $sabor) {
                $ventasSabor[] = $venta;
            }
        }
        return $ventasSabor;
    }

    public static function consultarVentasPorVaso($vaso) {
        $ventas = self::leerVentasJSON();
        $ventasVaso = [];
        foreach ($ventas as $venta) {
            if ($venta['vaso'] === $vaso) {
                $ventasVaso[] = $venta;
            }
        }
        return $ventasVaso;
    }

    public static function validarVenta($numeroPedido, $usuario, $sabor, $tipo, $vaso, $cantidad){
        $ventas = self::leerVentasJSON();
        if($ventas != null){
            foreach ($ventas as $venta) {
                if ($venta['numeroPedido'] == $numeroPedido && $venta['usuario'] == $usuario && $venta['sabor']>=$sabor && $venta['tipo']>=$tipo && $venta['vaso']>=$vaso && $venta['cantidad']>=$cantidad) {
                    return $venta;
                }
            }
        }  
        return null;  
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

    public static function actualizarVenta($numeroPedido, $nuevaFecha){

        $ventas = self::leerVentasJSON();
        foreach($ventas as $key => $venta){
            if ($venta['numeroPedido'] == $numeroPedido) {
                echo "exito";
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


    public static function borrarVenta($numeroPedido) {
        $ventas = self::leerVentasJSON();

        foreach ($ventas as $key => $venta) {
            if ($venta['numeroPedido'] == $numeroPedido) {
                $ventas[$key]['eliminado'] = true;
                break;
            }
        }
        self::guardarVentasJSON($ventas);
        echo "<br>Venta estado eliminado<br>";

        self::moverImagen($numeroPedido);
    
    }

    


}

