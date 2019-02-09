<?php
include_once ('Conexion.php');
include_once ('Revision.php');

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

    public function modificar_pares()
    {
        $this->sql="SELECT * FROM revisiones WHERE articulo={$this->revision->getArticulo()}";
        $result=pg_exec($this->conexion->getConexion(), $this->sql);
        if($row=pg_fetch_assoc($result)){
            $this->sql = "UPDATE revisiones SET  par = '" . $this->revision->getPar() . "', par2 = '" . $this->revision->getPar2() . "' , par3='" . $this->revision->getPar3() . "' where articulo = '" . $this->revision->getArticulo() . "';";
            pg_exec($this->conexion->getConexion(), $this->sql);
        }
        else {
            $this->sql="INSERT INTO revisiones (articulo,par,par2,par3) VALUES ({$this->revision->getArticulo()},'{$this->revision->getPar()}','{$this->revision->getPar2()}','{$this->revision->getPar3()}')";
            pg_exec($this->conexion->getConexion(), $this->sql);
        }
        echo 'Revision programada';
    }

    public function calificar($par,$nota){
        $this->sql="SELECT par,par2,par3 FROM revisiones WHERE articulo={$this->revision->getArticulo()}";
        $recurso=pg_exec($this->conexion->getConexion(),$this->sql);
        $row=pg_fetch_assoc($recurso);
        $nombre=$par->getNombre();
        if($row["par"]==$nombre){

            $this->sql="UPDATE revisiones SET nota1={$nota} WHERE articulo={$this->revision->getArticulo()}";
            pg_exec($this->conexion->getConexion(),$this->sql);
        }elseif($row["par2"]==$nombre){
            $this->sql="UPDATE revisiones SET nota2={$nota} WHERE articulo={$this->revision->getArticulo()}";
            pg_exec($this->conexion->getConexion(),$this->sql);
        }elseif($row["par3"]==$nombre){
            $this->sql="UPDATE revisiones SET nota3={$nota} WHERE articulo={$this->revision->getArticulo()}";
            pg_exec($this->conexion->getConexion(),$this->sql);
        }
        echo "Nota ingresada";
    }

}