<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["score"]) && empty($_POST["score"])) &&
    (isset($_POST["rachas"]) && empty($_POST["rachas"])) &&
    (isset($_POST["ncigs"]) && empty($_POST["ncigs"])) &&
    (isset($_POST["follow"]) && empty($_POST["follow"])) &&
    (isset($_POST["podium"]) && empty($_POST["podium"]))
) {
    echo json_encode(['error' => True, 'message' => "Por favor, completa todos los campos del formulario."]);
    exit;
}

require '../img_controller.php';

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$id = htmlspecialchars(trim($_POST["id"]));
$score = $_POST["score"];
validarInt($score, "puntuación");
if($score < 1 || $score > 5) {
    echo json_encode(['error' => True, 'message' => "La puntuación debe estar entre 1 y 5."]);
    exit;
}
$rachas = empty($_POST["rachas"]) ? 0 : $_POST["rachas"];
if($rachas != null) validarInt($rachas, "rachas");
$num_cig = empty($_POST["ncigs"]) ? null : $_POST["ncigs"];
if($num_cig != null) validarInt($num_cig, "cigarrillos");
$followers = empty($_POST["follow"]) ? 0 : $_POST["follow"];
if($followers != null) validarInt($followers, "seguidores");  
$podium = empty($_POST["podium"]) ? null : $_POST["podium"];
if($podium != null) validarInt($podium, "podium");

//Incluímos el modelo de usuario
require '../../models/retos.php';

$model = new RetosModel;

//Hacemos login con el email y contraseña introducido
$result = $model->updateReto($con, $id, $imgName, $score, $num_cig, $followers, $rachas, $podium);

if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
    $ruta = "../../media/retos/";
    move_uploaded_file($imgTmpName, $ruta . $imgName);
}

if ($result) {
    echo json_encode(['error' => False, 'message' => "Reto actualizado correctamente."]);
} else {
    echo json_encode(['error' => True, 'message' => "No se ha podido actualizar el nombre."]);
}

// Cerrar la conexión
$con = null;

exit;
