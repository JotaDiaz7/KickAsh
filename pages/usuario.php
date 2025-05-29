<?php
require_once '../config/head.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 0);

if (empty($_GET["id"]) || !isset($_GET["id"])) {
    header("Location: /error?error=Usuario no encontrado");
    exit;
}

$id = $_GET["id"];


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once '../structure/head.php' ?>
    <link rel="stylesheet" href="/styles/usuario.css">
    <link rel="stylesheet" href="/styles/main-usuario.css">
    <script type="module" src="/js/usuario.js"></script>
    <title>KickAsh</title>
</head>

<body>
    <section id="root">
        <?php include_once '../structure/header.php' ?>
        <main>
            <?php getUser($con, $id, $rolUser); ?>
        </main>
        <?php include_once '../structure/footer.php' ?>
    </section>
</body>

</html>