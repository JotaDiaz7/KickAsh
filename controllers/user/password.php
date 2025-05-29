<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["pass"]) && empty($_POST["pass"])) ||
(isset($_POST["passR"]) && empty($_POST["passR"]))) {
    echo json_encode(['error'=> True, 'message' => "Por favor, completa todos los campos del formulario."]);
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

//Atrapamos el valor de los campos del formulario
$pass = htmlspecialchars(trim($_POST["pass"]));
$passR = htmlspecialchars(trim($_POST["passR"]));

if($pass != $passR) {
    echo json_encode(['error'=> True, 'message' => "Ambas contraseñas deben coincidir."]);
    exit;
}

validarPassword($pass);

$pass = password_hash($pass, PASSWORD_DEFAULT);

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id= $user['id'];

//Hacemos login con el email y contraseña introducido
$result = $model->updatePassword($con, $id, $pass);

if ($result) {
    echo json_encode(['error'=> False, 'message' => "Contraseña actualizada correctamente."]);
} else {
    echo json_encode(['error'=> True, 'message' => "No se ha podido actualizar la contraseña."]);
}

// Cerrar la conexión
$con = null;

exit;