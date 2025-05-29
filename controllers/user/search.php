<?php

session_start();

if (!isset($_GET["search"]) || empty($_GET["search"])) {
    exit;
}

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/users.php';
$model = new UsersModel;

$result = $model -> search($con, $_GET["search"]);

echo json_encode($result);

// Cerrar la conexión
$con = null;

exit;