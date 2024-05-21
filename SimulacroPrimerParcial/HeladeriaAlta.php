<?php

include_once("Helado.php");

if(isset($_POST["sabor"]) && isset($_POST["precio"]) && isset($_POST["tipo"]) && isset($_POST["vaso"]) && isset($_POST["stock"]) && isset($_FILES["imagen"])){

    if($heladoExistente = Helado::buscarProductoExistente($_POST["sabor"],$_POST["tipo"]) != null){

        Helado::actualizarProducto($_POST["sabor"],$_POST["tipo"],$_POST["stock"]);

    }else{

        $helado = new Helado($_POST["sabor"],$_POST["precio"],$_POST["tipo"],$_POST["vaso"],$_POST["stock"]);
        
        if ($helado->esValido() != false){
            Helado::agregarProducto($helado);
            Helado::subirImagen($_FILES["imagen"],$_POST["sabor"], $_POST["tipo"]);
            echo "Producto agregado correctamente.";
        } else {
            echo "Error al crear el producto. Datos inválidos.";
        }
    }

} else {
    echo "Parametros incorrectos";
}