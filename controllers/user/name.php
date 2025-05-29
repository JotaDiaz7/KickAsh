<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["name"]) && empty($_POST["name"])) ||
    (isset($_POST["nameD"]) && empty($_POST["nameD"]))
) {
    echo json_encode(['error' => True, 'message' => "Por favor, completa el formulario con tu nombre."]);
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

//Atrapamos el valor de los campos del formulario
$name = htmlspecialchars(trim($_POST["name"] ?? $_POST["nameD"]));
validarTexto($name);

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id = $user['id'];

//Hacemos login con el email y contraseña introducido
$result = $model->updateName($con, $id, $name);

if ($result) {
    if (isset($_POST['nameD'])) {
        echo json_encode(['error' => False, 'message' => "Nombre actualizado correctamente."]);
    } else {
        echo json_encode(['temp' => '/templates/check2.php'], JSON_UNESCAPED_SLASHES);
    }
} else {
    echo json_encode(['error' => True, 'message' => "No se ha podido actualizar el nombre."]);
}

// Cerrar la conexión
$con = null;

exit;
