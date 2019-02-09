<?php
include_once ('Conexion.php');

class CRUDAutor
{
    var $autor;
    var $sql;
    var $conexion;

    public function __construct($autor)
    {
        $this->sql="";
        $this->autor=$autor;
        $this->conexion=new Conexion();
        $this->conexion->conectar();
    }

    public function ingresar()
    {
        $this->sql="INSERT INTO autores VALUES '".$this->autor->getNombre()."', '".$this->autor->getDireccion()."', ".$this->autor->getTelefono().", '".$this->autor->getEmail()."', '".$this->autor->getDepartamento()."', '".$this->autor->getUsuario()."', '".$this->autor->getPassword()."' ";
        pg_exec($this->conexion->getConexion(),$this->sql);
    }


    public function consultar()
    {
        if ($this->autor->getNombre()!="")
            $this->sql="SELECT * FROM autores WHERE nombre = '".$this->autor->getNombre()."';";
        elseif($this->autor->getUsuario()!=""){
            $this->sql="SELECT * FROM autores WHERE usuario = '".$this->autor->getUsuario()."';";
        }
        else
            $this->sql="SELECT * FROM autores";
        $Registros=pg_query($this->conexion->getConexion(),$this->sql);
        return($Registros);
    }

    public function modificar()
    {
        $this->sql="UPDATE autores SET nombre = '".$this->autor->getNombre()."', direccion = '".$this->autor->getDireccion()."', telefono = ".$this->autor->getTelefono().", email = '".$this->autor->getEmail()."', departamento = '".$this->autor->getDepartamento()."', usuario = '".$this->autor->getUsuario()."', password = '".$this->autor->getPassword()."' where nombre='{$this->autor->getNombre()}';";
        pg_exec($this->conexion->getConexion(), $this->sql);
    }

    public function modificar2($atributos){
        echo json_encode($atributos);
        $this->sql="update autores set ";
        foreach($atributos as $key =>$value){
            if($key!='telefono'){
                $this->sql .= "$key = '$value',";
            }else
                $this->sql.="$key = $value,";
        }
        $this->sql=substr($this->sql,0,-1);
        $this->sql.=" where nombre='{$this->autor->getNombre()}';";
        echo $this->sql;
        pg_exec($this->conexion->getConexion(), $this->sql);
    }

    public function borrar()
    {
        $this->sql="DELETE FROM autores WHERE nombre = '".$this->autor->getNombre()."' ";
        pg_exec($this->conexion->getConexion(), $this->sql);
    }

    public function obtener_articulos(){
        if($this->autor!=null)
            $this->sql="select ar.* from articulos ar inner join autores au on au.nombre = ar.autor where au.nombre='{$this->autor->getNombre()}'";
        else
            $this->sql="select ar.* from articulos ar inner join autores au on au.nombre = ar.autor";
        return pg_exec($this->conexion->getConexion(),$this->sql);
    }
}