<?php

include("Usuario.php");


if (isset($_GET["listado"])) {

    $listado = $_GET["listado"];

    switch ($listado) {
        case "usuarios":
            // Cargar usuarios desde el archivo CSV
            Usuario::leerUsuariosJSON();
            break;
        default:
            echo "Tipo de listado no válido.";
    }
} else {
    echo "El parámetro 'listado' no ha sido proporcionado.";
}

