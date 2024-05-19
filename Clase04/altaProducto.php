<?php

include("Producto.php");


if(isset($_POST["codigo"]) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["precio"])){


    if($productoExistente = Producto::buscarProductoExistente($_POST["codigo"]) != null){

        Producto::actualizarProducto($_POST["codigo"],$_POST["stock"]);

    }else{

        $producto = new Producto($_POST["codigo"],$_POST["nombre"],$_POST["tipo"],$_POST["stock"],$_POST["precio"]);
        Producto::agregarProducto($producto);
       
    }
    

} else {
    echo "No se pudo hacer";
}


