<?php

if(isset($_GET['accion'])){
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            switch ($_GET['accion']){
                case 'test':
                    include 'test.php';
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

