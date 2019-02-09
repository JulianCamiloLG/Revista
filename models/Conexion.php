<?php

class Conexion
{
    protected $conexion;

    //funcion para realizar la conexion
    public function __construct (){
        $this->conexion='';
    }

    public function conectar(){
        $this->conexion =pg_connect('dbname=proyecto2 user=postgres password=1234');
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