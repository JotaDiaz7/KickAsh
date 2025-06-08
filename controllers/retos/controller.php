<?php

function getRetos($con)
{
    require_once '../config/orderBuscarPag.php';
    $urlA = '/admin?retos&';
    require_once '../models/retos.php';
    $model = new RetosModel;
    $data = $model->getRetos($con, $inicio, $numItemsPag);
    $totalItems = $model->countRetos($con);
    include_once '../views/retos.php';
}

function getReto($con, $id)
{
    require_once '../models/retos.php';
    $model = new RetosModel;
    $data = $model->getReto($con, $id);
    if (!$data) {
        header("Location: /error?error=Reto no encontrado");
        exit;
    }
    include_once '../views/reto.php';
}

function checkRetos($con, $idUser)
{
    require_once '../models/retos.php';
    $modelR = new RetosModel;
    require_once '../models/historical.php';
    $modelH = new HistModel;
    global $logroC;

    // Vamos a comprobar las rachas
    $rachas = $modelH->getLastRegister($con, $idUser);
    $reto = $modelR->getRetosByRachaUser($con, $idUser, $rachas['rachas']);
    if (isset($reto['id'])) {
        $num_cig = $modelR->checkCigsInRacha($con, $idUser, $rachas['rachas'], $reto['num_cig'] == null ? 100 : $reto['num_cig']);
        if ($num_cig) {
            require_once '../models/followers.php';
            $modelF = new FollowModel;
            $followers = $modelF->countFollows($con, $idUser);

            if ($followers >= $reto['followers'] ?? 0) {
                require_once '../models/users.php';
                $modelU = new UsersModel;
                $podium = $modelU->getUserPodiumPosition($con, $idUser);
                if ($podium <= $reto['podium'] || $reto['podium'] == 0) {
                    $modelR->registrarLogro($con, $idUser, $reto['id']);
                    require_once '../config/PHPMailer/mails/logro.php';
                    $logroC = $reto['id'];
                }
            }
        }
    }
}

function getLogros($con, $idUser)
{
    require_once '../models/retos.php';
    $modelR = new RetosModel;
    $data = $modelR->getLogros($con, $idUser);
    include_once '../views/logros.php';
}

function getRetoUser($con, $id, $idUser)
{
    require_once '../models/retos.php';
    $modelR = new RetosModel;
    $data = $modelR->getRetoUser($con, $id, $idUser);
    if (!$data) {
        header("Location: /error?error=Reto no encontrado");
        exit;
    }
    include_once '../views/retoUser.php';
}

function getRetosNoUser($con, $idUser)
{
    require_once '../models/retos.php';
    $modelR = new RetosModel;
    $data = $modelR->getRetosNoUser($con, $idUser);
    include_once '../views/retosUser.php';
}

function popupLogro($con, $id)
{
    require_once '../models/retos.php';
    $modelR = new RetosModel;
    $data = $modelR->getReto($con, $id);

    include_once '../views/popupLogro.php';
}

function countRetosUser($con, $idUser)
{
    require_once '../models/retos.php';
    $modelR = new RetosModel;
    $data = $modelR->countRetosUser($con, $idUser);
    return $data;
}