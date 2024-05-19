<?php

class Usuario{
    public $nombre;
    public $clave;

    public $email;

    //Constructor
    public function __construct($nombre, $clave, $email) { 
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->email = $email;
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
}

