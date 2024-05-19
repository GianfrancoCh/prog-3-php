<?php

include("Producto.php");
include("Usuario.php");
include("Venta.php");


if(isset($_POST["codigo"]) && isset($_POST["id"]) && isset($_POST["cantidad"])){


    if(Venta::verificarProductoUsuario($_POST["codigo"],$_POST["id"])){

        echo "Venta Realizada";

    }else{

       echo "No se pudo hacer";
       
    }
    

} else {
    echo "Error en parametros";
}


