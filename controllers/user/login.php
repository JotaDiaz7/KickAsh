<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["user"]) && empty($_POST["user"])) || (isset($_POST["password"]) && empty($_POST["password"]))) {
    echo json_encode(['error' => True, 'message' => "Por favor, completa todos los campos del formulario."]);
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

//Atrapamos el valor de los campos del formulario
$password = htmlspecialchars(trim($_POST["password"]));
$user = htmlspecialchars(trim($_POST["user"]));

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;

//Hacemos login con el email y contraseña introducido
$result = $model->login($con, $user, $password);

if ($result) {
    $user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
    //La cookie dura un mes
    if(isset($_POST['checkbox']) && !empty($_POST['checkbox'])) setcookie("user", json_encode($user), time() + 30 * 24 * 60 * 60, '/');

    echo json_encode(["redirect" => $user['rol'] >= 1 ? "/admin" : "/cuenta"]);
} else {
    echo json_encode(['error' => True, 'message' => "Usuario o contraseña incorrecta."]);
}

// Cerrar la conexión
$con = null;

exit;
