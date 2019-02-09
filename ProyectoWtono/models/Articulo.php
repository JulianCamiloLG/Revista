<?php

class Articulo
{
    var $titulo;
    var $autor;
    var $idArticulo;
    var $resumen;
    var $temas;
    var $palabraClave;
    var $estado;
    var $ruta;

    public function __construct($titulo, $autor, $id, $resumen, $temas, $palabras, $estado, $ruta)
    {
        $this->titulo=$titulo;
        $this->autor=$autor;
        $this->idArticulo=$id;
        $this->resumen=$resumen;
        $this->temas=$temas;
        $this->palabraClave=$palabras;
        $this->estado=$estado;
        $this->ruta=$ruta;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getId()
    {
        return $this->idArticulo;
    }

    public function getResumen()
    {
        return $this->resumen;
    }

    public function getTemas()
    {
        return $this->temas;
    }

    public function getPalabras()
    {
        return $this->palabraClave;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setResumen($resumen)
    {
        $this->resumen = $resumen;
    }

    public function setTemas($temas)
    {
        $this->temas = $temas;
    }

    public function setPalabras($palabras)
    {
        $this->palabras = $palabras;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    }
}