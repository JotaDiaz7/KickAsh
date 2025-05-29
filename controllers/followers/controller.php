<?php

function getFollows($con, $idUser){
    //Vamos a llamar a nuestro modelo
    require_once '../models/followers.php';
    require_once '../config/orderBuscarPag.php';
    $urlA = '?follows&';

    $model = new FollowModel;
    $data = $model -> getFollows($con, $idUser, $inicio, $numItemsPag);
    $totalItems = $model -> countFollows($con, $idUser);
    include_once '../views/follows.php';
}

function getFollowers($con, $idUser){
    //Vamos a llamar a nuestro modelo
    require_once '../models/followers.php';
    require_once '../config/orderBuscarPag.php';
    $urlA = '?followers&';

    $model = new FollowModel;
    $data = $model -> getFollowers($con, $idUser, $inicio, $numItemsPag);
    $totalItems = $model -> countFollowers($con, $idUser);
    include_once '../views/followers.php';
}