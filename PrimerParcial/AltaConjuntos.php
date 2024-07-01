<?php

include_once("Venta.php");
include_once("Producto.php");
include_once("Conjunto.php");


if (isset($_POST['marcaImpresora'], $_POST['modeloImpresora'], $_POST['marcaCartucho'], $_POST['modeloCartucho']) && isset($_FILES['imagen'])) {
    // Suponemos que la función Producto::existeProducto verifica si el producto existe en tienda.json
    $existeImpresora = Producto::validarMarcaModeloTipo($_POST['marcaImpresora'], $_POST['modeloImpresora'],"impresora");
    $existeCartucho = Producto::validarMarcaModeloTipo($_POST['marcaCartucho'], $_POST['modeloCartucho'],"cartucho");

    if ($existeImpresora && $existeCartucho) {
        // Si ambos productos existen, creamos el conjunto
        $precioTotal = $existeImpresora['precio'] + $existeCartucho['precio']; // Suma de precios de ambos productos

        $conjunto = new Conjunto($_POST['marcaImpresora'],$_POST['marcaCartucho'],$_POST['modeloImpresora'],$_POST['modeloCartucho'],$precioTotal,"conjunto");

        // Guardar el objeto conjunto en el archivo JSON
        Conjunto::agregarConjunto($conjunto);
        Conjunto::subirImagen($_FILES["imagen"],$_POST["modeloImpresora"], $_POST["modeloCartucho"]);

    } else {
        // Informar si alguno de los productos no existe
        if (!$existeImpresora) {
            echo "No existe una impresora con marca '{$_POST['marcaImpresora']}' y modelo '{$_POST['modeloImpresora']}'.";
        }
        if (!$existeCartucho) {
            echo "No existe un cartucho con marca '{$_POST['marcaCartucho']}' y modelo '{$_POST['modeloCartucho']}'.";
        }
    }
} else {
    echo "Todos los campos son obligatorios.";
}
