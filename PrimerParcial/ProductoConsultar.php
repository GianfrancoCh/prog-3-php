<?php

include_once("Producto.php");

if(isset($_POST["marca"]) && isset($_POST["tipo"]) && isset($_POST["color"])){

    Producto::consultarProductoEspecifico($_POST["marca"],$_POST["tipo"],$_POST["color"]);

} else {
    echo "Parametros incorrectos";
}