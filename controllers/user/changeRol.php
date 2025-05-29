<?php

session_start();

if ((!isset($_GET["rol"]) || empty($_GET["rol"])) && (!isset($_GET["id"]) || empty($_GET["id"]))) {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$id = $_GET["id"];
$rol = $_GET["rol"];

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;
$result = $model -> changeRol($con, $id, $rol);

if ($result) {
    $textRol = $rol == 1 ? " ahora es administrador." : "  ya no es administrador.";
    echo json_encode(['error'=> False, 'message' =>"El usuario ".$id . $textRol]);
} else {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
}

// Cerrar la conexión
$con = null;

exit;
