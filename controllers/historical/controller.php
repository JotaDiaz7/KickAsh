<?php

function checkRegister($con, $idUser)
{
    //Vamos a ver qué fecha es hoy
    $date = date('Y-m-d');

    //Vamos a llamar a nuestro modelo
    require_once '../models/historical.php';

    $model = new HistModel;

    //Vamos a comprobar si ya existe el registro de hoy
    $check = $model->checkRegister($con, $idUser, $date);

    //Si no existe registro lo creamos
    if (!$check) {
        //Antes vamos a obtener su ahorro diario
        require_once '../models/money.php';
        $modelM = new MoneyModel;
        $money = $modelM->saveDay($con, $idUser);
        //Obtenemos el número de cigarros que fuma al día
        require_once '../models/users.php';
        $modelU = new UsersModel;
        $cig = $modelU->checkInfo2($con, $idUser);

        //Ahora vamos a obtener el registro del día de antes
        $last = $model->getLastRegister($con, $idUser);
        $rachas = 0;

        if ($last && isset($last['date'])) {
            $hoy = new DateTime($date);
            $ultimaFecha = new DateTime($last['date']);
        
            if ($hoy->diff($ultimaFecha)->days === 1 && $ultimaFecha < $hoy && $last['num_cig'] < $cig['num_cig_day']) {
                $rachas = $last['rachas'] + 1;
            }
        }
        //Creamos el registro
        $model->insertRegister($con, $idUser, $money, $rachas);
    }
}

function getCartera($con, $idUser){
    //Vamos a llamar a nuestro modelo
    require_once '../models/money.php';

    $model = new MoneyModel;
    $data = $model -> getMoney($con, $idUser);
    include_once '../views/cartera.php';
}

function getHist($con, $idUser, $hist){
    require_once '../config/orderBuscarPag.php';
    $urlA = '?historico&';
    if(!empty($hist)) list($dateS, $dateE) = explode('_', $_GET['historico']);
    require_once '../models/historical.php';
    $model = new HistModel;
    $data = $model -> getRegistersUser($con, $idUser, $dateS ?? "2025-04-29", $dateE ?? date('Y-m-d'), $inicio, $numItemsPag);
    $totalItems = $model -> countRegistersUser($con, $idUser, $dateS ?? "2025-04-29", $dateE ?? date('Y-m-d'));
    include_once '../views/historico.php';
}