<?php
include_once ('Conexion.php');

class CRUDArticulo
{
    var $articulo;
    var $sql;
    var $conexion;

    public function __construct($articulo)
    {
        $this->sql = "";
        $this->articulo = $articulo;
        $this->conexion = new Conexion();
        $this->conexion->conectar();
    }

    public function ingresar()
    {
        $id=$this->cantidad()["count"]*1+1;
        echo json_encode($id);
        $this->articulo->setIdArticulo($id);
        $this->sql = "INSERT INTO articulos VALUES ('" . $this->articulo->getTitulo() . "', '" . $this->articulo->getAutor() . "', " . $this->articulo->getId() . ", '" . $this->articulo->getResumen() . "', '" . $this->articulo->getTemas() . "', '" . $this->articulo->getPalabras() . "', '" . $this->articulo->getEstado()."', '".$this->articulo->getRuta()."')";
        pg_exec($this->conexion->getConexion(), $this->sql);
    }

    public function consultarPorTitulo()
    {
        if ($this->articulo->getTitulo() != "")
            $this->sql = "SELECT * FROM articulos WHERE titulo = '" . $this->articulo->getTitulo() . "';";
        else
            $this->sql = "SELECT * FROM articulos";
        $Registros = pg_query($this->conexion->getConexion(), $this->sql);
        return ($Registros);
    }

    public function consultarPorEstado()
    {
        if ($this->articulo->getEstado() != "")
            $this->sql = "SELECT * FROM articulo WHERE estado = '" . $this->articulo->getEstado() . "';";
        else
            $this->sql = "SELECT * FROM articulo";
        $Registros = pg_query($this->conexion->getConexion(), $this->sql);
        return ($Registros);
    }

    public function consultarPorPalabraClave()
    {
        if ($this->articulo->getPalabras() != "")
            $this->sql = "SELECT * FROM articulo WHERE palabras = '" . $this->articulo->getPalabras() . "';";
        else
            $this->sql = "SELECT * FROM articulo";
        $Registros = pg_query($this->conexion->getConexion(), $this->sql);
        return ($Registros);
    }

    public function modificar()
      {
          $this->sql="UPDATE articulos SET titulo = '".$this->articulo->getTitulo()."', nombre = '".$this->articulo->getNombre()."', id = '".$this->articulo->getId()."', resumen = '".$this->articulo->getResumen()."', temas = '".$this->articulo->getTemas()."' palabras = '".$this->articulo->getPalabras()."', estado = '".$this->articulo->getEstado()."' WHERE titulo = '".$this->articulo->getTitulo()."', ruta='".$this->articulo->getRuta()."'";
          pg_exec($this->conexion->getConexion(), $this->sql);
      }

    public function borrar()
    {
        $this->sql="DELETE FROM articulos WHERE titulo = '".$this->articulo->getTitulo()."' ";
        pg_exec($this->conexion->getConexion(), $this->sql);
    }

    public function cantidad(){
        $this->sql="select count(*) from articulos;";
        $result=pg_exec($this->conexion->getConexion(),$this->sql);
        $row=pg_fetch_assoc($result);
        return $row;
    }

    public function articulo_revision(){
        $this->sql="select a.id id, a.titulo titulo,a.autor autor,a.temas temas,a.estado estado, r.calificacion calificacion, r.par par,r.par2 par2,r.par3 par3
                    from articulos a left OUTER join revisiones r
                    on a.id = r.articulo;";
        $result=pg_exec($this->conexion->getConexion(),$this->sql);
        $dict=Array();
        while($row=pg_fetch_assoc($result)){
            array_push($dict,$row);
        }
        return $dict;
    }
}