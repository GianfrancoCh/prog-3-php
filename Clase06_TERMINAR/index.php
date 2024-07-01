<?php
require_once 'clases/UsuarioControler.php';

$usuarioController = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'listar':
                switch($_GET["tipo"]){
                    case 'usuarios':
                        $datos = $usuarioController->listarUsuarios();
                        echo json_encode($datos);
                        break;
                }
                break;
                
        }
    } else {
        echo json_encode(['error' => 'Falta el parametro action']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'registro':
                if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['clave']) && isset($_POST['mail']) && isset($_POST['localidad'])) {
                    $resultado = $usuarioController->insertarUsuario($_POST['nombre'], $_POST['apellido'], $_POST['clave'], $_POST['mail'], $_POST['localidad']);
                    echo json_encode(['resultado' => $resultado]);
                } else {
                    echo json_encode(['error' => 'Faltan parametros']);
                }
                break;
            case 'login':
                if (isset($_POST['clave']) && isset($_POST['mail'])){

                }
                break;
            default:
                echo json_encode(['error' => 'Accion no valida']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Falta el parametro action']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $putData);

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'modificar':
                break;
            default:
                echo json_encode(['error' => 'Accion no valida']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Falta el parametro action']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'borrar':
            default:
                echo json_encode(['error' => 'Accion no valida']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Falta el parametro action']);
    }
} else {
    echo json_encode(['error' => 'Metodo HTTP no permitido']);
}
?>