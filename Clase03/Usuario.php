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

    public function GuardarUsuarioCSV($usuario) {
      
    }
}

?>