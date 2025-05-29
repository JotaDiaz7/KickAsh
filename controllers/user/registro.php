<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["user"]) && empty($_POST["user"]))
    || (isset($_POST["email"]) && empty($_POST["email"]))
    || (isset($_POST["password"]) && empty($_POST["password"]))
) {
    echo json_encode(['error' => True, 'message' => "Por favor, completa todos los campos del formulario."]);
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/users.php';
$model = new UsersModel;

$id = htmlspecialchars(trim($_POST["user"]));
validarUser($id);
$check = $model->comprobarId($con, $id);

if ($check) {
    echo json_encode(['error' => True, 'message' => "Usuario ya registrado."]);
    exit;
}

//Comprobamos email, su formato y que no exista ya
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
validarEmail($email);
$check = $model->comprobarEmail($con, $email);

if ($check) {
    echo json_encode(['error' => True, 'message' => "Email ya registrado."]);
    exit;
}

//Atrapamos el resto de valores de los campos del formulario
$password = htmlspecialchars(trim($_POST["password"]));
validarPassword($password);

// Comprobamos que hayan aceptado los términos y condiciones
if (empty($_POST["checkbox"])) {
    echo json_encode(['error' => True, 'message' => "Por favor, acepta nuestra política de privacidad y de cookies."]);
    exit;
}

//Vamos a encriptar la contraseña
$passwordEnc = password_hash($password, PASSWORD_DEFAULT);

//Registramos al cliente
$check = $model->registro($con, $id, $email, $passwordEnc);

if ($check) {
    echo json_encode(['error' => False, 'message' => "¡Enhorabuena te has registrado con éxito! Ya puedes iniciar sesión."]);
    require_once '../../config/PHPMailer/mails/register.php';
}


// Cerrar la conexión
$con = null;

exit;
