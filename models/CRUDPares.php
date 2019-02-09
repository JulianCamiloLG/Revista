<?php
include_once ('Conexion.php');

class CRUDPares
{
    var $pares;
    var $sql;
    var $conexion;

    public function __construct($pares)
    {
        $this->sql="";
        $this->pares=$pares;
        $this->conexion=new Conexion();
        $this->conexion->conectar();
    }

    public function ingresar()
    {
        $this->sql="INSERT INTO pares VALUES '".$this->pares->getNombre()."', '".$this->pares->getDireccion()."', ".$this->pares->getTelefono().", '".$this->pares->getEmail()."', '".$this->pares->getEspecializacion()."', '".$this->pares->getUsuario()."', '".$this->pares->getPassword()."', '".$this->pares->getDepartamento()."' ";
        pg_exec($this->conexion->getConexion(),$this->sql);
    }

    public function consultar()
    {
        if ($this->pares->getNombre()!="")
            $this->sql="SELECT * FROM pares WHERE nombre = '".$this->pares->getNombre()."';";
        elseif($this->pares->getUsuario()!=""){
            $this->sql="SELECT * FROM pares WHERE usuario = '".$this->pares->getUsuario()."';";
        }
        else
            $this->sql="SELECT * FROM pares";
        $Registros=pg_query($this->conexion->getConexion(),$this->sql);
        return($Registros);
    }

    public function modificar()
    {
        $this->sql="UPDATE autores SET nombre = '".$this->autor->getNombre()."', direccion = '".$this->autor->getDireccion()."', telefono = ".$this->autor->getTelefono().", email = '".$this->autor->getEmail()."', especializacion = '".$this->autor->getEspecializacion()."', usuario = '".$this->autor->getUsuario()."', password = '".$this->autor->getPassword()."', departamento = '".$this->autor->getDepartamento()."' ";
        pg_exec($this->conexion->getConexion(), $this->sql);
    }

    public function borrar()
    {
        $this->sql="DELETE FROM revisiones WHERE nombre = '".$this->pares->getNombre()."' ";
        pg_exec($this->conexion->getConexion(), $this->sql);
    }
}