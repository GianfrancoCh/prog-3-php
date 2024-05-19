<?php

include_once("Helado.php");

if(isset($_POST["sabor"]) && isset($_POST["precio"]) && isset($_POST["tipo"]) && isset($_POST["vaso"]) && isset($_POST["stock"])){

    $helado = new Helado($_POST["sabor"], $_POST["precio"], $_POST["tipo"], $_POST["vaso"], $_POST["stock"]);

    

    Helado::guardarHeladoJSON($helado);
    
} else {
    echo "Parametros incorrectos";
}