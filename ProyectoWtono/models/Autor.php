<?php

class Autor
{
    var $nombre;
    var $direccion;
    var $telefono;
    var $email;
    var $departamento;
    var $usuario;
    var $password;

    public function __construct($nombre, $direccion, $telefono, $email, $departamento, $usuario, $password)
    {
        $this->nombre=$nombre;
        $this->direccion=$direccion;
        $this->telefono=$telefono;
        $this->email=$email;
        $this->departamento=$departamento;
        $this->usuario=$usuario;
        $this->password=$password;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


}