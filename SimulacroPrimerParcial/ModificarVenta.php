<?php

include_once("Venta.php");
include_once("Helado.php");

parse_str(file_get_contents("php://input"), $_PUT);

if(isset($_PUT["numeroPedido"]) && isset($_PUT["email"]) && isset($_PUT["sabor"]) && isset($_PUT["tipo"]) && isset($_PUT["vaso"]) && isset($_PUT["cantidad"]) && isset($_PUT["fecha"])){

    
    if($ventaExistente = Venta::validarVenta($_PUT["numeroPedido"],$_PUT["email"],$_PUT["sabor"],$_PUT["tipo"],$_PUT["vaso"],$_PUT["cantidad"]) != null){

        Venta::actualizarVenta($_PUT["numeroPedido"],$_PUT["fecha"]);
    }else{

        echo "No hay stock de ese helado";
    }
    

} else {
    echo "Parametros incorrectos";
}