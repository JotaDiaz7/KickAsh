<?php

if (isset($_SESSION["user"]) || isset($_COOKIE["user"])) {
    $user = $_SESSION["user"] ?? json_decode($_COOKIE["user"], true);
    $id = $user['id'];
    $rol = $user['rol'];
}

function seguridad($sesion, $rolSeguridad, $rolUsuario)
{
    //En caso de que no queramos que vean la página si no está logueado pondremos true en el primer parámetro
    //Además, vamos a comprobar el rol para saber si puede estar en esta página
    if($rolUsuario >= 1){
        $location = "Location: /admin";
    }else if($rolUsuario == 0){
        $location = "Location: /cuenta";
    }else{
        $location = "Location: /";
    }
    if ($sesion && $rolSeguridad > $rolUsuario) {
        header($location);
        exit;
    }
}