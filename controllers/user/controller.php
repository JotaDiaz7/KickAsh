<?php

function imgUser($con, $user, $header)
{
    require_once '../models/users.php';
    $model = new UsersModel;
    $data = $model->getImg($con, $user);
    include_once $header ? '../views/imgHeader.php' : '../views/imgUser.php';
}

function getUsers($con)
{
    require_once '../config/orderBuscarPag.php';
    $urlA = '/admin?';
    require_once '../models/users.php';

    $model = new UsersModel;
    $data = $model->getUsers($con, $inicio, $numItemsPag);
    $totalItems = $model->countUsers($con);
    include_once '../views/usuarios.php';
}

function getUser($con, $id, $rolUser)
{
    require_once '../models/users.php';
    $model = new UsersModel;
    $data = $model->getUser($con, $id, $rolUser);
    if (!$data) {
        header("Location: /error?error=Usuario no encontrado");
        exit;
    }
    require_once '../models/historical.php';
    $modelH = new HistModel;
    require_once '../models/retos.php';
    $modelR = new RetosModel;
    require_once '../models/followers.php';
    $modelF = new FollowModel;
    include_once $rolUser == 0 ? '../views/usuario.php' : '../views/user.php';
}

function checkers($con, $id, $rolUser)
{
    require_once '../models/users.php';
    $model = new UsersModel;
    $data = $model->checkName($con, $id);
    $data2 = $model->checkInfo($con, $id);
    $data3 = $model->checkInfo2($con, $id);
    if (empty($data['name'])) {
        include_once '../templates/check.php';
    } else if (empty($data2['price_cig'])) {
        include_once '../templates/check2.php';
    } else if (empty($data3['num_cig_day'])) {
        include_once '../templates/check3.php';
    } else {
        getUser($con, $id, $rolUser);
    }
}

function calculadora($con, $id)
{
    require_once '../models/users.php';
    $model = new UsersModel;
    $data = $model->getCalc($con, $id);
    if (!empty($data)) {

        // 1) Datos históricos antes de la app
        $yearsSmoked     = floatval($data['smoke_time']);    // años antes del registro
        $histAvgDaily    = floatval($data['num_cig_day']);   // cig/día histórico
        $histDays        = $yearsSmoked * 365;               // días históricos
        $histCigsTotal   = $histAvgDaily * $histDays;        // cigarrillos totales

        // 2) Datos logueados en la app
        $loggedDays      = intval($data['total']);           // días que ha registrado
        $loggedAvgDaily  = floatval($data['avg_cig']);       // promedio cig en esos días
        $loggedCigsTotal = $loggedAvgDaily * $loggedDays;    // cig totales logueados

        // 3) Totales acumulados
        $totalCigs       = $histCigsTotal + $loggedCigsTotal;
        $lungWeightG     = 1200;                             // peso pulmonar en gramos

        // 4) Rendimientos máximos (mg por cigarrillo)
        $yieldsMg = [
            'tar'      => 10.0,
            'nicotine' => 1.2,
            'co'       => 13.0,
        ];

        // 5) Cálculo % mass-to-mass para cada componente
        $calc = [];
        foreach ($yieldsMg as $comp => $mgPerCig) {
            // masa total en g
            $massTotalG = ($mgPerCig * $totalCigs) / 1000.0;
            // % respecto al peso pulmonar
            $calc[$comp] = round(($massTotalG / $lungWeightG) * 100, 2);
        }
        include_once '../views/state.php';
    }
}

function dataUser($con, $id)
{
    require_once '../models/users.php';
    $model = new UsersModel;
    $data = $model->getUser($con, $id, '');
    include_once '../views/dataUser.php';
}
function dataUser2($con, $id)
{
    require_once '../models/users.php';
    $model = new UsersModel;
    $data = $model->getUser($con, $id, '');
    include_once '../views/dataUser2.php';
}

function podium($con, $idUser)
{
    require_once '../models/historical.php';
    $modelH = new HistModel;
    require_once '../models/retos.php';
    $modelR = new RetosModel;

    $rachas = $modelH->getLastRegister($con, $idUser);
    $score = $modelR->getTotalScoreByUser($con, $idUser);
    return $rachas['rachas'] + $score;
}

function getPodium($con, $idUser)
{
    require_once '../models/users.php';
    $model = new UsersModel;
    $data = $model->getPodium($con);
    include_once '../views/podium.php';
}
