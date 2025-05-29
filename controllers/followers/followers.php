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
$follow = $_GET["follow"];

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$userId= $user['id'];

require '../../models/followers.php';

$model = new FollowModel;

//Comprobamos si el usuario sigue al usuario que está viendo
$follower = $model -> checkFollow($con, $userId, $id_f); 

if(!$follower & $follow == 1) $result = $model -> setFollower($con, $userId, $id_f);
if($follower & $follow == 0) $result = $model -> deleteFollower($con, $userId, $id_f);

$followers = $model->countFollowers($con, $id_f);
$follows = $model->countFollows($con, $id_f);

if (isset($result) && $result) {
    $text = $follow == 0 ? "Has dejado de seguir a ".$id_f : "Has empezado a seguir a ".$id_f;
    echo json_encode(['error'=> False, 'message' => $text, 'followers' => $followers, 'follows' => $follows]);
} else {
    echo json_encode(['error'=> True, 'message' => "No se ha podido completar la operación."]);
}

// Cerrar la conexión
$con = null;

exit;