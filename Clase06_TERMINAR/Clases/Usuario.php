<?php

include './db/AccesoDatos.php';
class Usuario{

    public $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $localidad;

    public function mostrarDatos()
    {
        return "Usuario:" . $this->nombre . "  " . $this->apellido . "  " . $this->mail . " " . $this->localidad;
    }

    public function InsertarUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,apellido,clave,mail,localidad)values('$this->nombre','$this->apellido','$this->clave','$this->mail','$this->localidad')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function InsertarUsuarioParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,apellido,clave,mail,localidad)values(:nombre,:apellido,:clave,:mail,:localidad)");
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function TraerTodosLosUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select id,nombre,apellido,clave,localidad from usuarios");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");
    }

    public static function TraerUnUsuario($id)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select id,nombre,apellido,clave,localidad from usuarios where id = $id");
        $consulta->execute();
        $cdBuscado = $consulta->fetchObject('usuario');
        return $cdBuscado;
    }

    public static function buscarUsuarioMailClave($clave, $mail)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("select clave, mail WHERE clave=? AND mail=?");
        $consulta->execute(array($clave, $mail));
        $cdBuscado = $consulta->fetchObject('usuario');
        return $cdBuscado;
    }

//     public static function TraerUnCdAnioParamNombre($id, $anio)
//     {
//         $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
//         $consulta = $objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
//         $consulta->bindValue(':id', $id, PDO::PARAM_INT);
//         $consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
//         $consulta->execute();
//         $cdBuscado = $consulta->fetchObject('cd');
//         return $cdBuscado;
//     }

//     public static function TraerUnCdAnioParamNombreArray($id, $anio)
//     {
//         $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
//         $consulta = $objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
//         $consulta->execute(array(':id' => $id, ':anio' => $anio));
//         $consulta->execute();
//         $cdBuscado = $consulta->fetchObject('cd');
//         return $cdBuscado;
//     }

//     public function ModificarCd()
//     {

//         $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
//         $consulta = $objetoAccesoDato->RetornarConsulta("
// 				update cds 
// 				set titel='$this->titulo',
// 				interpret='$this->cantante',
// 				jahr='$this->año'
// 				WHERE id='$this->id'");
//         return $consulta->execute();
//     }

//     public function ModificarCdParametros()
//     {
//         $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
//         $consulta = $objetoAccesoDato->RetornarConsulta("
// 				update cds 
// 				set titel=:titulo,
// 				interpret=:cantante,
// 				jahr=:anio
// 				WHERE id=:id");
//         $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
//         $consulta->bindValue(':titulo', $this->titulo, PDO::PARAM_INT);
//         $consulta->bindValue(':anio', $this->año, PDO::PARAM_STR);
//         $consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
//         return $consulta->execute();
//     }

//     public function BorrarCd()
//     {
//         $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
//         $consulta = $objetoAccesoDato->RetornarConsulta("
// 				delete 
// 				from cds 				
// 				WHERE id=:id");
//         $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
//         $consulta->execute();
//         return $consulta->rowCount();
//     }

//     public static function BorrarCdPorAnio($año)
//     {
//         $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
//         $consulta = $objetoAccesoDato->RetornarConsulta("
// 				delete 
// 				from cds 				
// 				WHERE jahr=:anio");
//         $consulta->bindValue(':anio', $año, PDO::PARAM_INT);
//         $consulta->execute();
//         return $consulta->rowCount();
//     }
}


