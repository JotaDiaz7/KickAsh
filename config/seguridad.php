<?php

if (isset($_SESSION["user"]) || isset($_COOKIE["user"])) {
    $user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
    $idUser = $user['id'];
    $rolUser = $user['rol'];
}

function seguridad(bool $requiereSesion, int $rolPermitido)
{
    $user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
    $rol = $user['rol'] ?? -1;

    // Si requiere sesión y no hay usuario logueado
    if ($requiereSesion && $rol < 0) {
        header("Location: /");
        exit;
    }

    // Si hay sesión y no se requiere (páginas como login, register)
    if (!$requiereSesion && $rol >= 0) {
        header("Location: " . ($rol >= 1 ? "/admin" : "/cuenta"));
        exit;
    }

    // Si el rol del usuario no es compatible con la página
    if ($requiereSesion && ($rol >= 1 && $rolPermitido == 0 || $rol == 0 && $rolPermitido >= 1)) {
        header("Location: " . ($rol >= 1 ? "/admin" : "/cuenta"));
        exit;
    }
}
