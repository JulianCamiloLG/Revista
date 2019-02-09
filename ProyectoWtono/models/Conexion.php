<?php

class Conexion
{
    protected $conexion;

    //funcion para realizar la conexion
    public function __construct (){
        $this->conexion='';
    }

    public function conectar(){
        $this->conexion =pg_connect('dbname=revista user=prog3 password=12345678');
        if(!$this->conexion)
            echo json_encode("Error al conectar");
    }

    public function __destruct (){
        $this->conexion;
    }

    public function getConexion(){
        return($this->conexion);
    }
}