<?php

class Usuario
{
    var $usuario;
    var $password;

    public function __construct($user,$password)
    {
        $this->usuario=$user;
        $this->password=$password;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getPassword()
    {
        return $this->password;
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