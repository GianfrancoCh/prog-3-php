<?php

include("Usuario.php");


if(isset($_POST["nombre"]) && isset($_POST["clave"]) && isset($_POST["email"]) && isset($_FILES["archivo"])){

    $usuario = new Usuario($_POST["nombre"],$_POST["clave"],$_POST["email"]);
    Usuario::subirImagen($_FILES["archivo"]);
    Usuario::guardarUsuarioJSON($usuario);

} else {
    echo "Parametros incorrectos";
}


