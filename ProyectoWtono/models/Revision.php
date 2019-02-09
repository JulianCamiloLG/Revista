<?php

class Revision
{
    var $articulo;
    var $par;
    var $calificacion;
    var $comentarios;
    var $estado;
    var $par2;
    var $par3;
    var $nota1;
    var $nota2;
    var $nota3;
    var $promedio;

    public function __construct($articulo, $par, $calificacion, $comentarios, $estado, $par2, $par3, $nota1, $nota2, $nota3, $promedio)
    {
        $this->articulo=$articulo;
        $this->par=$par;
        $this->calificacion=$calificacion;
        $this->comentarios=$comentarios;
        $this->estado=$estado;
        $this->par2=$par2;
        $this->par3=$par3;
        $this->nota1=$nota1;
        $this->nota2=$nota2;
        $this->nota3=$nota3;
        $this->promedio=$promedio;
    }

    public function getArticulo()
    {
        return $this->articulo;
    }

    public function getPar()
    {
        return $this->par;
    }

    public function getCalificacion()
    {
        return $this->calificacion;
    }

    public function getComentarios()
    {
        return $this->comentarios;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setArticulo($articulo)
    {
        $this->articulo = $articulo;
    }

    public function setPar($par)
    {
        $this->par = $par;
    }

    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    }

    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getPar2()
    {
        return $this->par2;
    }

    public function setPar2($par2)
    {
        $this->par2 = $par2;
    }

    public function getNota1()
    {
        return $this->nota1;
    }

    public function setNota1($nota1)
    {
        $this->nota1 = $nota1;
    }

    public function getNota2()
    {
        return $this->nota2;
    }

    public function setNota2($nota2)
    {
        $this->nota2 = $nota2;
    }

    public function getNota3()
    {
        return $this->nota3;
    }

    public function setNota3($nota3)
    {
        $this->nota3 = $nota3;
    }

    public function getPar3()
    {
        return $this->par3;
    }

    public function setPar3($par3)
    {
        $this->par3 = $par3;
    }

    public function getPromedio()
    {
        return $this->promedio;
    }

    public function setPromedio($promedio)
    {
        $this->promedio = $promedio;
    }

}