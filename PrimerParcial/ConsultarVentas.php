<?php

include_once("Venta.php");
include_once("Producto.php");

if(isset($_GET["filtro"]) && isset($_GET["parametro"])){

    $filtro = $_GET["filtro"];

    switch ($filtro) {
        case 'fecha':

            $fechaParametro = $_GET["parametro"] ?? '';  
            if (!empty($fechaParametro)) {
                $fechaProcesada = strtotime($fechaParametro);
                if ($fechaProcesada === false) {
                    $fecha = date('d-m-Y');
                    echo "Fecha proporcionada es inválida. Mostrando ventas de hoy: ";
                } else {
                    $fecha = date('d-m-Y', $fechaProcesada);
                }
            } else {
                
                $fecha = date('d-m-Y', strtotime('-1 day'));
                echo "No se proporcionó fecha. Mostrando ventas de ayer: ";
            }
            $cantidad = Venta::consultarVentasPorFecha($fecha);
            echo "Cantidad de productos vendidos en $fecha: " . $cantidad;
        break;

        case 'usuario':
            $usuario = $_GET["parametro"];
            $ventasUsuario = Venta::consultarVentasPorUsuario($usuario);
            echo "Ventas del usuario $usuario: ";
            foreach($ventasUsuario as $venta){
                echo 
                "<br>Numero Pedido: ".$venta['numeroPedido'] . 
                ", Fecha: ".$venta['fecha'] .
                ", Usuario: ".$venta['usuario'].
                ", Tipo: ".$venta['tipo']. 
                ", Marca: ".$venta['marca'].
                ", Color: ".$venta['color'].
                ", Cantidad: ".$venta['cantidad'].
                "<br>";
            }
        break;

        case 'precio':

            $precio = $_GET["parametro"];
            if(isset($_GET["parametro2"])){
                
                $precio2 = $_GET["parametro2"];
                $productosPrecio = Producto::consultarProductosPrecio($precio, $precio2);
                echo "Productos entre ".$precio." y ".$precio2;
                foreach($productosPrecio as $producto){
                    echo "<br> : Marca: ".$producto['marca'] . " Tipo: ".$producto['tipo'] ." Modelo: ".$producto['modelo']." Color: ".$producto['color']." Precio: ".$producto['precio']."<br>";
                }
            }
            else{
                echo "Falta segundo parametro";
            }

            break;
        case 'tipo':
            $tipo = $_GET["parametro"];
            $ventasTipo = Venta::consultarVentasPorTipo($tipo);
            echo "Ventas con de tipo '$tipo': ";
            foreach($ventasTipo as $venta){
                echo "<br> Numero Pedido: ".$venta['numeroPedido'] . " Fecha: ".$venta['fecha'] ." Usuario: ".$venta['usuario']." Tipo: ".$venta['tipo']." Marca: ".$venta['marca']." Color: ".$venta['color']." Cantidad: ".$venta['cantidad']."<br>";
            }
            break;

        case 'ingresos':

            $fechaParametro = $_GET["parametro"] ?? '';  
            $ingresos = Venta::consultarIngresos($fechaParametro);
            if($fechaParametro === null){
                echo "Los ingresos totales de las ventas: " . $ingresos;
            }else{
                echo "Los ingresos totales de las ventas en: ".$fechaParametro." son: ". $ingresos;
            }
            break;

        case 'producto':
            $producto = Venta::consultarProductoMasVendido();
            if ($producto) {
                echo "El producto más vendido es: Marca ".$producto["marca"].", Tipo ".$producto["tipo"].", Modelo ".$producto["modelo"] . 
                ", Color " . $producto["color"] . " con " . $producto["cantidad"] . " unidades vendidas.";
            } else {
                echo "No se pudo determinar el producto más vendido.";
            }
        break;

        default:
            echo "Filtro no válido";
            break;
    }
    

} else {
    echo "Parametros incorrectos";
}