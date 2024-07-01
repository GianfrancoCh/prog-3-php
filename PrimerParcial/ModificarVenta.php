<?php


include_once("Venta.php");
include_once("Producto.php");

parse_str(file_get_contents("php://input"), $_PUT);

if(isset($_PUT["numeroPedido"]) && isset($_PUT["email"]) && isset($_PUT["marca"]) && isset($_PUT["tipo"]) && isset($_PUT["modelo"]) && isset($_PUT["cantidad"]) && isset($_PUT["fecha"])){

    
    if($ventaExistente = Venta::validarVenta($_PUT["numeroPedido"],$_PUT["email"],$_PUT["marca"],$_PUT["tipo"],$_PUT["modelo"],$_PUT["cantidad"]) != null){
        
        Venta::modificarVenta($_PUT["numeroPedido"],$_PUT["fecha"]);
    }else{

        echo "No existe esa venta";
    }
    
} else {

    echo "Parametros incorrectos";
}