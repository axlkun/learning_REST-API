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
        $contenido = file_get_contents("../data/usuarios.json");
        $usuarios = json_decode($contenido,true);
        $usuarios[] = array(
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "fechaNacimiento" => $this->fechaNacimiento,
            "genero" => $this->genero
        );
        $archivo = fopen("../data/usuarios.json","w");
        fwrite($archivo,json_encode($usuarios));
        fclose($archivo);
    }
    public static function obtenerUsuarios(){
        $contenido = file_get_contents("../data/usuarios.json");
        echo $contenido;
    }

    public static function obtenerUsuario($indice){
        $contenido = file_get_contents("../data/usuarios.json"); //cadena json
        $usuarios = json_decode($contenido,true); //convierte el json en un arreglo asociativo
        $usuarioEncontrado = json_encode($usuarios[$indice]); //el resultado se vuelve a convertir en formato json
        echo $usuarioEncontrado;
    }
    public function actualizarUsuario($indice){
        $contenido = file_get_contents("../data/usuarios.json"); //cadena json
        $usuarios = json_decode($contenido,true); //convierte el json en un arreglo asociativo
        
        $usuario = array(
            'nombre'=> $this->nombre,
            'apellido'=> $this->apellido,
            'fechaNacimiento'=> $this->fechaNacimiento,
            'genero'=> $this->genero
        );
        //se sustituye el usuario del indice mandado por el creado en el array
        $usuarios[$indice] = $usuario; 
        //hasta el momento todo esta en memoria
        $archivo = fopen('../data/usuarios.json',"w");
        fwrite($archivo,json_encode($usuarios));
        fclose($archivo);
    }

    public static function eliminarUsuario($indice){
        $contenido = file_get_contents("../data/usuarios.json"); //cadena json
        $usuarios = json_decode($contenido,true); //convierte el json en un arreglo asociativo
        array_splice($usuarios,$indice,1); //arreglo, indice y cantidad de elementos a eliminar
        //solo se realizo en memoria por lo que se debe volver a escribir
        $archivo = fopen('../data/usuarios.json',"w"); //abre el archivo json
        fwrite($archivo,json_encode($usuarios)); //sustituye el antiguo json por el nuevo
        fclose($archivo);
    }
    
}

?>