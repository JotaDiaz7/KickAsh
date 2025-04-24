<?php

function imgUser($con, $user){
    require_once '../models/users.php';
    $model = new UsersModel;
    $data = $model -> getImg($con, $user);
    include_once '../views/imgHeader.php';
}