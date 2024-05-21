<?php

class Usuario{
    public $nombre;
    public $clave;

    public $email;

    public $fechaRegistro;

    //Constructor
    public function __construct($nombre, $clave, $email) {
        $this->id = $this->generateID();
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->email = $email;
        $this->fechaRegistro = date("Y-m-d H:i:s");

    }


    private function generateID() {
        $filePath = 'usuarios.json';
        $usuarios = [];
        if (file_exists($filePath)) {
            $usuarios = json_decode(file_get_contents($filePath), true);
        }

        do {
            $id = rand(1, 10000);
            $flagID = true;
            foreach ($usuarios as $usuario) {
                if ($usuario['id'] == $id) {
                    $flagID = false;
                    break;
                }
            }
        } while (!$flagID);

        return $id;
    }


    public static function guardarUsuarioJSON($usuario){

        $usuarios = [];

        if (file_exists("usuarios.json")) {
            $contenido = file_get_contents("usuarios.json");
            $usuarios = json_decode($contenido, true);
        }

        $usuarios[] = array(
            "id" => $usuario->id,
            "nombre" => $usuario->nombre,
            "clave" => $usuario->clave,
            "email" => $usuario->email,
            "fechaRegistro" => $usuario->fechaRegistro
        );

        $json = json_encode($usuarios);
        file_put_contents("usuarios.json", $json);
        echo "<p>Se guardó el usuario en JSON</p>";

    }
    public static function guardarUsuarioCSV($usuario) {

        $archivo = fopen("usuarios.csv", "a");
        if($archivo){
            fwrite($archivo, $usuario->nombre . "," . $usuario->clave . "," . $usuario->email . "\n");
            echo "<p>Usuario guardado correctamente en el archivo CSV.</p>";
        }
        else{
            echo "<p>Error al abrir el archivo CSV.</p>";
        }

        fclose($archivo);
    }


    public static function leerUsuarioCSV(){
        
        $archivo = fopen("usuarios.csv", "r");
        echo "<ul>";

        while(!feof($archivo)){
            $linea = fgets($archivo);   
            echo "<li>$linea</li>";
            
        }
        echo "</ul>";
        fclose($archivo);
    
    }


    public static function encontrarUsuario($email, $clave) {

        $archivo = fopen("usuarios.csv", "r");
        $usuarioEncontradoFlag = false;
        
        while(!feof($archivo)){
            $linea = fgets($archivo);
            $elementosLinea = explode(",", $linea);
            
            if($elementosLinea[2] === $email && $elementosLinea[1] === $clave){
                $usuarioEncontradoFlag = true;
                echo "Verificado";  
                break;
            }else if($elementosLinea[2] === $email && $elementosLinea[1] != $clave){
                echo "Error en los datos"; 
                break;   
            }

        }

        if (!$usuarioEncontradoFlag) {
            echo "Usuario no registrado";
        }
        
        fclose($archivo);

        echo "<br/>";
    }


    public static function leerUsuariosJSON(){

        $usuarios = [];

        if (file_exists("usuarios.json")) {
            $contenido = file_get_contents("usuarios.json");
            $usuarios = json_decode($contenido, true);
            foreach($usuarios as $usuario){
                echo "ID: " . $usuario["id"], "Nombre: ". $usuario["nombre"] . "Email: ". $usuario["email"] . "<br>";
            }
        }
        else{

            echo "<p>No hay un archivo de usuarios</p>";
        }

            
    }

    public static function subirImagen($imagen){

        $carpeta_archivos = 'Usuario/';

        // Datos del arhivo enviado por POST
        $nombre_archivo = $_FILES['archivo']['name'];
        $tipo_archivo = $_FILES['archivo']['type'];
        $tamano_archivo = $_FILES['archivo']['size'];

        // Ruta destino, carpeta + nombre del archivo que quiero guardar
        $ruta_destino = $carpeta_archivos . $nombre_archivo;

        // Realizamos las validaciones del archivo
        if (!((strpos($tipo_archivo, "png") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 300000))) {
            echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .png o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
        }else{
            if (move_uploaded_file($_FILES['archivo']['tmp_name'],  $ruta_destino)){
                    echo "El archivo ha sido cargado correctamente.";
            }else{
                    echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
            }
        }
    }
}

