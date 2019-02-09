<?php
include_once ('Conexion.php');

class CRUDRevision
{
    var $revision;
    var $sql;
    var $conexion;

    public function __construct($revision)
    {
        $this->sql="";
        $this->revision=$revision;
        $this->conexion=new Conexion();
        $this->conexion->conectar();
    }

    public function ingresar()
    {
        $this->sql="INSERT INTO revisiones VALUES '".$this->revision->getArticulo()."', '".$this->revision->getPar()."', ".$this->revision->getCalificacion().", '".$this->revision->getComentarios()."', '".$this->revision->getEstado()."', '".$this->revision->getPar2()."', '".$this->revision->getPar3()."', ".$this->revision->getNota1().", ".$this->revision->getNota2().", ".$this->revision->getNota3().", ".$this->revision->getPromedio()." ";
        pg_exec($this->conexion->getConexion(),$this->sql);
    }

    public function consultarporArticulo()
    {
        if ($this->revision->getArticulo()!="")
            $this->sql="SELECT * FROM revisiones WHERE articulo = '".$this->revision->getArticulo()."';";
        else
            $this->sql="SELECT * FROM revisiones";
        $Registros=pg_query($this->conexion->getConexion(),$this->sql);
        return($Registros);
    }

    public function consultarporEstado()
    {
        if ($this->revision->getEstado()!="")
            $this->sql="SELECT * FROM revisiones WHERE estado = '".$this->revision->getEstado()."';";
        else
            $this->sql="SELECT * FROM revisiones";
        $Registros=pg_query($this->conexion->getConexion(),$this->sql);
        return($Registros);
    }

    public function modificar()
    {
        $this->sql="UPDATE revisiones SET articulo = '".$this->revision->getArticulo()."', par = '".$this->revision->getPar()."', calificacion = ".$this->revision->getCalificacion().", comentarios = '".$this->revision->getComentarios()."', estado = '".$this->revision->getEstado()."', par2 = '".$this->revision->getPar2()."' , par3='".$this->revision->getPar3()."', nota1=".$this->revision->getNota1().", nota2=".$this->revision->getNota2().", nota3=".$this->revision->getNota3().", promedio=".$this->revision->getPromedio()."  ";
        pg_exec($this->conexion->getConexion(), $this->sql);
    }

}