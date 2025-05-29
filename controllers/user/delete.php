<?php

session_start();

if (!isset($_POST['checkbox'])) {
    echo json_encode(['error' => True, 'message' => "Por favor, confirma que quieres eliminar tu cuenta."]);
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id = $user['id'];

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;
$result = $model->changeState($con, $id, 0);

if ($result) {
    echo json_encode(['error' => False]);

    $_SESSION = array();

    session_unset();
    session_destroy();

    if (isset($_COOKIE)) {
        setcookie("user", '', time() - 3600, '/');
        setcookie("user", '', time() - 3600, '/', $_SERVER['HTTP_HOST']);
    }
} else {
    echo json_encode(['error' => True, 'message' => "No se ha podido completar la operación."]);
}

// Cerrar la conexión
$con = null;

exit;
