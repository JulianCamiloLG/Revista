<?php

include_once ('Conexion.php');

class CRUDUsuario
{
    var $usuario;
    var $sql;
    var $conexion;

    public function __construct($usuario)
    {
        $this->sql="";
        $this->usuario=$usuario;
        $this->conexion=new Conexion();
        $this->conexion->conectar();
    }

    public function ingresar()
    {
        $this->sql="INSERT INTO usuarios VALUES ('".$this->usuario->getUsuario()."', '".$this->usuario->getPassword()."') ;";
        $resul=pg_query($this->conexion->getConexion(),$this->sql);
        if (!$resul) {
            # code...
            echo "error al ingresar";
        }
        echo "usuario creado satisfactoreamente";
    }

    public function consultar()
    {
        # code...
        $this->sql="SELECT * FROM usuarios WHERE usuario='{$this->usuario->getUsuario()}' and password='{$this->usuario->getPassword()}';";
        $resul=pg_query($this->conexion->getConexion(),$this->sql);

        if (!$resul) {
            # code...
            echo "el usuario no existe";
            return false;
        }
        //echo "usuario y contraseña validos";
        return true;
    }
}