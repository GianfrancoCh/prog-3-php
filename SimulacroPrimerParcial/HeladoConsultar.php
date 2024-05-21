<?php

include_once("Helado.php");

if(isset($_POST["sabor"]) && isset($_POST["tipo"])){

    if($heladoExistente = Helado::buscarProductoExistente($_POST["sabor"],$_POST["tipo"]) != null){

        echo "existe";

    }else{

        echo "no existe";
    }

} else {
    echo "Parametros incorrectos";
}