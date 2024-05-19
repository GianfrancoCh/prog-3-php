<?php

// Recibe los datos del usuario(clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
// un :
// “Verificado” si el usuario existe y coincide la clave también.
// “Error en los datos” si esta mal la clave.
// “Usuario no registrado si no coincide el mail“
// Hacer los métodos necesarios en la clase usuario.


include("Usuario.php");


if(isset($_POST["clave"]) && isset($_POST["email"])){

    Usuario::encontrarUsuario($_POST["email"], $_POST["clave"]);

} else {
    echo "Parametros incorrectos";
}