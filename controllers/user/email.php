<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if (isset($_POST["email"]) && empty($_POST["email"])) {
    echo json_encode(['error' => True, 'message' => "Por favor, completa el formulario con tu email."]);
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

//Comprobamos email, su formato y que no exista ya
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
validarEmail($email);

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id = $user['id'];

$check = $model->comprobarEmail($con, $email);

if ($check) {
    echo json_encode(['error' => True, 'message' => "Email ya registrado."]);
    exit;
}

//Hacemos login con el email y contraseña introducido
$result = $model->updateEmail($con, $id, $email);

if ($result) {
    echo json_encode(['error' => False, 'message' => "Email actualizado correctamente."]);
} else {
    echo json_encode(['error' => True, 'message' => "No se ha podido actualizar el email."]);
}

// Cerrar la conexión
$con = null;

exit;
