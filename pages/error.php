<?php
require_once '../config/head.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, -1);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once '../structure/head.php' ?>
    <link rel="stylesheet" href="/styles/cuenta.css">
    <script type="module" src="/js/cuenta.js"></script>
    <title>KickAsh</title>
</head>

<body>
    <section id="root">
        <?php include_once '../structure/header.php' ?>
        <main>
            <?php
            checkers($con, $idUser, $rolUser);
            
            include_once '../templates/alert.php' ?>
        </main>
        <?php include_once '../structure/footer.php' ?>
    </section>
</body>

</html>