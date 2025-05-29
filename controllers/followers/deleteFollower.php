<?php

session_start();

if ((!isset($_GET["id"]) || empty($_GET["id"])) && (!isset($_GET["follow"]) || empty($_GET["follow"]))) {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$id_f = $_GET["id"];

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$userId= $user['id'];

require '../../models/followers.php';

$model = new FollowModel;

$result = $model -> deleteFollower($con, $id_f, $userId);

if (isset($result) && $result) {
    echo json_encode(['error'=> False, 'message' => 'El usuario '.$id_f.' ya no es tu seguidor.']);
} else {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
}

// Cerrar la conexión
$con = null;

exit;