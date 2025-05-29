<?php

session_start();

if ((!isset($_GET["activo"]) || empty($_GET["activo"])) && (!isset($_GET["id"]) || empty($_GET["id"]))) {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$id = $_GET["id"];
$active = $_GET["activo"];

//Incluímos el modelo de usuario
require '../../models/retos.php';

$model = new RetosModel;
$result = $model -> changeState($con, $id, $active);

if ($result) {
    echo json_encode(['error'=> $active == 1 ? False : True, 'message' => $active == 1 ? "Has activado el reto ".$id : "Has desactivado el reto ".$id]);
} else {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
}

// Cerrar la conexión
$con = null;

exit;
