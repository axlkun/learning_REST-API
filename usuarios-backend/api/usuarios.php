<?php

//Recibir peticiones del usuario

//echo 'Informacion: ' . file_get_contents('php://input');
header("Content-Type: application/json");
include_once('../classes/Usuario.php');

switch($_SERVER['REQUEST_METHOD']){

    case 'POST':
        //transforma el formato json en un arreglo asociativo
        $_POST = json_decode(file_get_contents('php://input'),true);
        $usuario = new Usuario($_POST['nombre'],$_POST['apellido'],$_POST['fechaNacimiento'],$_POST['genero']);
        $usuario->guardarUsuario(); 
        $resultado["mensaje"] = "Guardar el usuario " . json_encode($_POST);
        echo json_encode($resultado);
        break;
    
    case 'GET':
        if(isset($_GET['id'])){
            Usuario::obtenerUsuario($_GET['id']);
        }else{
            Usuario::obtenerUsuarios();
        }
        break;

    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'),true); 
        $usuario = new Usuario($_PUT['nombre'],$_PUT['apellido'],$_PUT['fechaNacimiento'],$_PUT['genero']);
        $usuario->actualizarUsuario($_GET['id']);
        $resultado["mensaje"] = "Actualizar el usuario con id: " . $_GET['id'] . ", con la siguiente informacion: " . json_encode($_PUT);
        echo json_encode($resultado);
        break;
    
    case 'DELETE':

        Usuario::eliminarUsuario($_GET['id']);
        $resultado['mensaje'] = "Eliminar usuario con el id: " . $_GET['id'];
        echo json_encode($resultado);
        break; 
}

?>