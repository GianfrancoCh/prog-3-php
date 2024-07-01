<?php
//DESPUES DE LA ENTREGA
include_once("Venta.php");
include_once("Producto.php");

parse_str(file_get_contents("php://input"), $_DELETE);
if(isset($_DELETE["numeroPedido"])){
    
    if($ventaExistente = Venta::validarVentaNumeroPedido($_DELETE["numeroPedido"]) != null){

        Venta::borrarVenta($_DELETE["numeroPedido"]);
    }else{

        echo "No existe venta con ese numero de pedido";
    }
    

} else {
    echo "Parametros incorrectos";
}