<?php

//Recibir peticiones del usuario

//echo 'Informacion: ' . file_get_contents('php://input');
header("Content-Type: application/json");
switch($_SERVER['REQUEST_METHOD']){

    case 'POST':
        //transforma el formato json en un arreglo asociativo
        $_POST = json_decode(file_get_contents('php://input'),true); 
        $resultado["mensaje"] = "Guardar el usuario " . json_encode($_POST);
        echo json_encode($resultado);
        break;
    
    case 'GET':
        if(isset($_GET['id'])){
            $resultado["mensaje"] = "Retornar usuario con id: " . $_GET['id'];
            echo json_encode($resultado);
        }else{
            $resultado["mensaje"] = "Retornar todos los usuarios";
            echo json_encode($resultado);
        }
        break;

    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'),true); 
        $resultado["mensaje"] = "Actualizar el usuario con id: " . $_GET['id'] . ", con la siguiente informacion: " . json_encode($_PUT);
        echo json_encode($resultado);
        break;
    
    case 'DELETE':
        $resultado['mensaje'] = "Eliminar usuario con el id: " . $_GET['id'];
        echo json_encode($resultado);
        break; 
}

?>