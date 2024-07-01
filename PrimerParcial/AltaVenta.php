<?php

include_once("Venta.php");
include_once("Producto.php");

if(isset($_POST["marca"]) && isset($_POST["tipo"]) && isset($_POST["modelo"]) && isset($_POST["stock"]) && isset($_POST["email"]) && isset($_POST["numeroPedido"]) && isset($_FILES["imagen"])){


    if($producto = Producto::validarStock($_POST["marca"],$_POST["tipo"],$_POST["modelo"],$_POST["color"],$_POST["stock"]) != null){
        //Modifique despues entrega
        $precio = Producto::obtenerPrecioProducto($_POST["marca"],$_POST["tipo"],$_POST["modelo"],$_POST["color"]);
        $venta = new Venta($_POST["numeroPedido"],$_POST["email"],$_POST["stock"],$_POST["marca"],$_POST["tipo"],$_POST["modelo"],$_POST["color"],$precio);
        //Modifique despues entrega /\
        Venta::agregarVenta($venta);
        Venta::subirImagen($_FILES["imagen"],$_POST["marca"], $_POST["tipo"], $_POST["modelo"], $_POST["email"]);
    
    }else{

        echo "No hay stock de ese producto";
    }
    

} else {
    echo "Parametros incorrectos";
}