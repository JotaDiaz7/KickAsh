<?php
session_start();

require '../img_controller.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id= $user['id'];

//Hacemos login con el email y contraseña introducido
$result = $model->updateImg($con, $id, $imgName);

$ruta = "../../media/users/";
move_uploaded_file($imgTmpName, $ruta.$imgName);

if ($result) {
    echo json_encode(['error'=> False, 'message' => "Imagen actualizada correctamente."]);
} else {
    echo json_encode(['error'=> True, 'message' => "No se ha podido actualizar la imagen."]);
}

// Cerrar la conexión
$con = null;

exit;