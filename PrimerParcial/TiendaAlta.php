<?php

include_once("Producto.php");

if(isset($_POST["marca"]) && isset($_POST["precio"]) && isset($_POST["tipo"]) && isset($_POST["modelo"]) && isset($_POST["color"]) && isset($_POST["stock"]) && isset($_FILES["imagen"])){


    if($productoExistente = Producto::buscarProductoExistente($_POST["marca"],$_POST["tipo"]) != null){

        Producto::actualizarProductoPrecio($_POST["marca"],$_POST["tipo"],$_POST["stock"],$_POST["precio"]);

    }else{

        $producto = new Producto($_POST["marca"],$_POST["precio"],$_POST["tipo"],$_POST["modelo"],$_POST["color"],$_POST["stock"]);
        
        if ($producto->esValido() != false){
            Producto::agregarProducto($producto);
            Producto::subirImagen($_FILES["imagen"],$_POST["modelo"], $_POST["tipo"]);
            echo "Producto agregado correctamente.";
        } else {
            echo "Error al crear el producto. Datos inválidos.";
        }
    }

} else {
    echo "Faltan parametros";
}