<?php

include_once("Venta.php");
include_once("Helado.php");

if(isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["vaso"]) && isset($_POST["stock"]) && isset($_POST["email"]) && isset($_POST["numeroPedido"])){

    
    if($heladoExistente = Helado::validarStock($_POST["sabor"],$_POST["tipo"],$_POST["stock"]) != null){
        $venta = new Venta($_POST["numeroPedido"],$_POST["email"],$_POST["stock"],$_POST["sabor"],$_POST["tipo"],$_POST["vaso"]);
        Venta::agregarVenta($venta);
        Venta::subirImagen($_FILES["imagen"],$_POST["sabor"], $_POST["tipo"], $_POST["vaso"], $_POST["email"]);
    }else{

        echo "No hay stock de ese helado";
    }
    

} else {
    echo "Parametros incorrectos";
}