<?php

if(isset($_GET['accion'])){
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            switch ($_GET['accion']){
                case 'ventas':
                    include 'ConsultarVentas.php';
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
        case 'POST':
            switch ($_GET['accion']){
                case 'alta':
                    include 'HeladeriaAlta.php';
                    break;
                case 'consulta':
                    include 'HeladoConsultar.php';
                    break;
                case 'venta':
                    include 'AltaVenta.php';
                    break;
                case 'devolver':
                    include 'DevolverHelado.php';
                    break;
                default:
                    echo 'Parámetro "accion" no permitido';
                    break;
            }
            break;    
        case "DELETE":
            switch ($_GET['accion']){
                case 'borrar':
                    include 'BorrarVenta.php';
                    break;
                default:
                    echo 'Parámetro "accion" no permitido';
                    break;
            }
            break;
        default:
            echo 'Verbo no permitido';
            break;
    }
} else {
    echo 'Parámetro "accion" no enviado';
}

