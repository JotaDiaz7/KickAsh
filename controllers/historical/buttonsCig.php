<?php
session_start();

//Incluímos la configuración a la base de datos
require '../../config/config.php';

//Establecemos conexión
$con = conectar_db();

$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$id= $user['id'];

//Incluímos el modelo de money
require '../../models/money.php';
$modelM = new MoneyModel;
$costCig = $modelM -> costCig($con, $id);//Queremos saber cuánto le cuesta un cigarro

//Incluímos el modelo de histórico
require '../../models/historical.php';
$model = new HistModel;
$data = $model -> getRegister($con, $id);//Vamos a saber el número de cigarros que lleva

if(isset($_GET['plus'])){
    $model -> plusCig($con, $id, $costCig);
}else if(isset($_GET['minus'])){
    if($data['num_cig'] > 0) $model -> minusCig($con, $id, $costCig);
}

//Volvemos a obtener el registro
$data = $model -> getRegister($con, $id);

echo json_encode($data);

// Cerrar la conexión
$con = null;

exit;