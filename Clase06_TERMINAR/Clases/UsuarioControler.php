<?php

require_once 'Usuario.php';

class UsuarioController {

    public function insertarUsuario($nombre, $apellido, $clave, $mail, $localidad) {
        $usuario = new Usuario();
        $usuario->nombre = $nombre;
        $usuario->apellido = $apellido;
        $usuario->clave = $clave;
        $usuario->mail = $mail;
        $usuario->localidad = $localidad;
        return $usuario->InsertarUsuarioParametros();
    }
    
    public function listarUsuarios() {
        return Usuario::TraerTodosLosUsuarios();
    }
    public function buscarCdPorId($id) {
        $retorno = Usuario::TraerUnUsuario($id);
        if($retorno === false) { // Validamos que exista y si no mostramos un error
            $retorno =  ['error' => 'No existe ese id'];
        }
        return $retorno;
    }
    public function loginUsuario($clave, $mail) {
        $retorno = usuario::buscarUsuarioMailClave($clave, $mail);
        if($retorno === false) { 
            $retorno =  ['error'];
        }
        return $retorno;

    }
    
        // public function modificarCd($id, $nombre, $apellido, $clave, $mail) {
        //     $usuario = new Usuario();
        //     $usuario->id = $id;
        //     $usuario->nombre = $nombre;
        //     $usuario->apellido = $apellido;
        //     $usuario->clave = $clave;
        //     $usuario->mail = $mail;
        //     return $usuario->ModificarCdParametros();
        // }
    
        // public function borrarUsuario($id) {
        //     $usuario = new usuario();
        //     $usuario->id = $id;
        //     return $usuario->BorrarUsuario();
        // }


}