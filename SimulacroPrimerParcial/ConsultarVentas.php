<?php

include_once("Venta.php");
include_once("Helado.php");

if(isset($_GET["filtro"]) && isset($_GET["parametro"])){

    $filtro = $_GET["filtro"];
    $parametro = $_GET["parametro"];

    switch ($filtro) {
        case 'fecha':
            $cantidad = Venta::consultarVentasPorFecha($parametro);
            echo "Cantidad de helados vendidos en $parametro: " . $cantidad;
            break;

        case 'usuario':
            $ventasUsuario = Venta::consultarVentasPorUsuario($parametro);
            echo "Ventas del usuario $parametro: ";
            foreach($ventasUsuario as $venta){
                echo "<br> Numero Pedido: ".$venta['numeroPedido'] . " Fecha: ".$venta['fecha'] ." Usuario: ".$venta['usuario']." Sabor: ".$venta['sabor']." Tipo: ".$venta['tipo']." Vaso: ".$venta['vaso']." Cantidad: ".$venta['cantidad']."<br>";
            }
            break;

        case 'fechas':
            if(isset($_GET["parametro2"])){
                $fecha1 = $parametro;
                $fecha2 = $_GET["parametro2"];
                $ventasEntreFechas = Venta::consultarVentasPorFechas($fecha1, $fecha2);
                echo "Ventas entre ".$fecha1." y ".$fecha2;
                foreach($ventasEntreFechas as $venta){
                    echo "<br> Numero Pedido: ".$venta['numeroPedido'] . " Fecha: ".$venta['fecha'] ." Usuario: ".$venta['usuario']." Sabor: ".$venta['sabor']." Tipo: ".$venta['tipo']." Vaso: ".$venta['vaso']." Cantidad: ".$venta['cantidad']."<br>"; 
                }
            }
            else{
                echo "Falta segundo parametro";
            }
            

            break;
        case 'sabor':
            $ventasSabor = Venta::consultarVentasPorSabor($parametro);
            echo "Ventas con sabor $parametro: ";
            foreach($ventasSabor as $venta){
                "<br> Numero Pedido: ".$venta['numeroPedido'] . " Fecha: ".$venta['fecha'] ." Usuario: ".$venta['usuario']." Sabor: ".$venta['sabor']." Tipo: ".$venta['tipo']." Vaso: ".$venta['vaso']." Cantidad: ".$venta['cantidad']."<br>";
            }
            break;

        case 'vaso':
            if ($parametro == 'cucurucho'){
                $ventasCucurucho = Venta::consultarVentasPorVaso($parametro);
                echo "Ventas con vaso Cucurucho:<br>";
                foreach($ventasCucurucho as $venta){
                    "<br> Numero Pedido: ".$venta['numeroPedido'] . " Fecha: ".$venta['fecha'] ." Usuario: ".$venta['usuario']." Sabor: ".$venta['sabor']." Tipo: ".$venta['tipo']." Vaso: ".$venta['vaso']." Cantidad: ".$venta['cantidad']."<br>";
                }
            } else {
                echo "Parámetro vaso no válido";
            }
            break;

        default:
            echo "Filtro no válido";
            break;
    }
    

} else {
    echo "Parametros incorrectos";
}