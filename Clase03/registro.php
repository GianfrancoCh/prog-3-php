<?php


/*método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario */


include("Usuario.php");


if(isset($_POST["nombre"]) && isset($_POST["clave"]) && isset($_POST["email"])){

    $usuario = new Usuario($_POST["nombre"],$_POST["clave"],$_POST["email"]);

    Usuario::guardarUsuarioCSV($usuario);

} else {
    echo "Parametros incorrectos";
}


