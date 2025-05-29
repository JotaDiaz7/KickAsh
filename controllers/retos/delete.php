<?php

session_start();

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$id = $_GET["id"];

//Incluímos el modelo de usuario
require '../../models/retos.php';

$model = new RetosModel;
$model -> deleteLogro($con, $id);
$result = $model -> delete($con, $id);

if ($result) {
    echo json_encode(["redirect" => "/admin?retos&delete"]);
} else {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
}

// Cerrar la conexión
$con = null;

exit;
