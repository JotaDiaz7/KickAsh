<?php

session_start();

if (!isset($_GET["search"]) || empty($_GET["search"])) {
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/followers.php';
$model = new FollowModel;

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id = $user['id'];

if ($_GET['type'] == 'follow') {
    $result = $model->searchFollows($con, $_GET["search"], $id);
} else {
    $result = $model->searchFollowers($con, $_GET["search"], $id);
}

echo json_encode($result);

// Cerrar la conexión
$con = null;

exit;
