<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if (!isset($_POST["years"]) || $_POST["years"] === '' || !isset($_POST["ncigs"]) || $_POST["ncigs"] === '') {
    echo json_encode(['error'=> True, 'message' => "Por favor, completa el formulario con tu nombre."]);
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$years = $_POST["years"];
validarInt($years, 'años');
$ncigs = $_POST["ncigs"];
validarInt($ncigs, 'número de cigarrillos');

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id= $user['id'];

$result = $model->updateInfoCigs2($con, $id, $ncigs, $years);

if ($result) {
    echo json_encode(['temp' => "/templates/check4.php"]);
} else {
    echo json_encode(['error'=> True, 'message' => "No se han podido actualizar los datos."]);
}

// Cerrar la conexión
$con = null;

exit;