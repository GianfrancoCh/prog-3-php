<?php

include_once("Venta.php");
include_once("Helado.php");


if(isset($_GET["numeroPedido"])){
    
    if($ventaExistente = Venta::validarVentaNumeroPedido($_GET["numeroPedido"]) != null){

        Venta::borrarVenta($_GET["numeroPedido"]);
    }else{

        echo "No existe venta con ese numero de pedido";
    }
    

} else {
    echo "Parametros incorrectos";
}