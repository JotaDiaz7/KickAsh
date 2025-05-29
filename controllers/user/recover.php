<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["email"]) && empty($_POST["email"]))) {
    echo json_encode(['error' => True, 'message' => "Por favor, completa el formulario con tu correo."]);
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

//Comprobamos email, su formato y que no exista ya
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
validarEmail($email);
$check = $model->comprobarEmail($con, $email);

if (!$check) {
    echo json_encode(['error' => True, 'message' => "Email no registrado."]);
    exit;
}

//Atrapamos el resto de valores de los campos del formulario
$password = generarPasswrod();

//Vamos a encriptar la contraseña
$passwordEnc = password_hash($password, PASSWORD_DEFAULT);

//Cambiamos la contraseña del usuario
$check = $model->updatePassword($con, $email, $passwordEnc);

if ($check) {
    echo json_encode(['error' => False, 'message' => "Hemos enviado una contraseña temporal a tu correo electrónico."]);
    require_once '../../config/PHPMailer/mails/recover.php';
}

// Cerrar la conexión
$con = null;

exit;
