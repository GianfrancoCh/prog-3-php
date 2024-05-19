

<?php

// Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
// usuarios).
// En el caso de usuarios carga los datos del archivo usuarios.csv.
// se deben cargar los datos en un array de usuarios.
// Retorna los datos que contiene ese array en una lista

include("Usuario.php");

if (isset($_GET["listado"])) {
    $listado = $_GET["listado"];

    switch ($listado) {
        case "usuarios":
            // Cargar usuarios desde el archivo CSV
            Usuario::leerUsuarioCSV();
            break;
        default:
            echo "Tipo de listado no válido.";
    }
} else {
    echo "El parámetro 'listado' no ha sido proporcionado.";
}



