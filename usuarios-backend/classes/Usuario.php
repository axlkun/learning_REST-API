<?php

class Usuario{
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $genero;

    public function __construct($nombre,$apellido,$fechaNacimiento,$genero)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->genero = $genero;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    public function __toString()
    {
        return $this->nombre . " " . $this->apellido . " " . $this->fechaNacimiento . " " . $this->genero;
    }

    public function guardarUsuario(){
        
    }
    public function obtenerUsuario(){

    }
    public function actualizarUsuario(){

    }
    public function eliminarUsuario(){

    }
    
}

?>