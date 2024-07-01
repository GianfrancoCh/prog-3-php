<?php

if(isset($_GET['accion'])){
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            switch ($_GET['accion']){
                case 'consultar':
                    include 'ConsultarVentas.php';
                    break;
            }
            break;
        case 'POST':
            switch ($_GET['accion']){
                case 'alta':
                    include 'TiendaAlta.php';
                    break; 
                case 'consulta':
                    include 'ProductoConsultar.php';
                    break; 
                case 'venta':
                    include 'AltaVenta.php';
                case 'conjunto':
                    include 'AltaConjuntos.php';
                    break; 
            }
            break; 
        case 'PUT':
            parse_str(file_get_contents("php://input"),$put_vars);
            switch ($_GET['accion']){
                case 'modificar':
                    include 'ModificarVenta.php';
                    break;
            }
            break;  
        case 'DELETE':
            switch ($_GET['accion']){
                case 'borrar':
                    include 'BorrarVenta.php';
                    break;
            }
            break;  

    }
} else {
    echo 'Parámetro "accion" no enviado';
}

