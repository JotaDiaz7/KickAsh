<?php
session_start();

//Vamos a comprobar que todos los campos estén completados
if ((isset($_POST["name"]) && empty($_POST["name"]))) {
    echo json_encode(['error'=> True, 'message' => "Por favor, registra un nombre para el reto."]);
    exit;
}

if ((isset($_POST["score"]) && empty($_POST["score"]))) {
    echo json_encode(['error'=> True, 'message' => "Por favor, registra una puntuación para el reto."]);
    exit;
}

if (empty($_POST["rachas"]) && empty($_POST["ncigs"]) && empty($_POST["follow"]) && empty($_POST["podium"])) {
    echo json_encode(['error'=> True, 'message' => "Por favor, registra al menos una característica para el reto."]);
    exit;
}

//Vamos a incluir el archivo que contiene el resto de funciones de validación
require '../../config/utils.php';

//Incluímos la configuración a la base de datos
require '../../config/config.php';
//Establecemos conexión
$con = conectar_db();

//Incluímos el modelo de usuario
require '../../models/retos.php';
$model = new RetosModel;

$name = htmlspecialchars(trim($_POST["name"]));
$id = crearIdReto($name);
$check = $model->comprobarId($con, $id);

if ($check) {
    echo json_encode(['error'=> True, 'message' => "Reto ya registrado."]);
    exit;
}

require '../img_controller.php';

$score = htmlspecialchars(trim($_POST["score"]));
validarInt($score, "puntuación");
if($score < 1 || $score > 5) {
    echo json_encode(['error'=> True, 'message' => "La puntuación debe estar entre 1 y 5."]);
    exit;
}  

$rachas = empty($_POST["rachas"]) ? 0 : $_POST["rachas"];
if($rachas != null) validarInt($rachas, "rachas");
$ncigs = empty($_POST["ncigs"]) ? null : $_POST["ncigs"];
if($ncigs != null) validarInt($ncigs, "cigarrillos");
$follow = empty($_POST["follow"]) ? 0 : $_POST["follow"];
if($follow != null) validarInt($follow, "seguidores");  
$podium = empty($_POST["podium"]) ? null : $_POST["podium"];
if($podium != null) validarInt($podium, "podium");

//Registramos al cliente
$model->registro($con, $id, $name, $imgName, $score, $ncigs, $follow, $rachas, $podium);

$ruta = "../../media/retos/";

move_uploaded_file($imgTmpName, $ruta.$imgName);

// Cerrar la conexión
$con = null;

echo json_encode(["redirect" => "/admin?retos"]);
exit;