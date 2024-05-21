<?php

include_once("Helado.php");
include_once("Venta.php");
include_once("Devolucion.php");
include_once("Cupon.php");

if(isset($_POST["numeroPedido"]) && isset($_POST["causa"]) && isset($_FILES["imagen"])){

    if($ventaExistente = Venta::validarVentaNumeroPedido($_POST["numeroPedido"]) != null){

        $devolucion = new Devolucion($_POST["numeroPedido"],$_POST["causa"]);
        Devolucion::agregarDevolucion($devolucion);

    }else{

        "No existe venta con ese numero de pedido";
    }

} else {
    echo "Parametros incorrectos";
}