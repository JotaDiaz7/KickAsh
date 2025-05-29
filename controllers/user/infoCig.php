<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["precio"]) && empty($_POST["precio"]) || isset($_POST["cigs"]) && empty($_POST["cigs"])) ||
isset($_POST["price_cig"]) && empty($_POST["price_cig"]) || isset($_POST["num_cig"]) && empty($_POST["num_cig"])) {
    echo json_encode(['error'=> True, 'message' => "Por favor, completa todos los campos del formulario."]);
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$precio = $_POST["precio"] ?? $_POST["price_cig"];
validarPrecio($precio);

$num_cigs = $_POST["cigs"] ?? $_POST["num_cig"];
validarInt($num_cigs, 'cantidad');

//Incluímos el modelo de usuario
require '../../models/users.php';

$model = new UsersModel;

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id= $user['id'];

if(isset($_POST['cigs'])) $result = $model-> insertInfoCigs($con, $id, $precio, $num_cigs);
if(isset($_POST['num_cig'])) $result = $model-> updateInfoCigs($con, $id, $precio, $num_cigs);

if ($result) {
    if(isset($_POST['num_cig'])){
        echo json_encode(['error'=> False, 'message' => "Datos actualizados correctamente."]);
    }else{
    echo json_encode(['temp' => "/templates/check3.php"]);
    }
} else {
    echo json_encode(['error'=> True, 'message' => "No se han podido actualizar los datos."]);
}

// Cerrar la conexión
$con = null;

exit;