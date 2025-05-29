<?php
require_once '../config/head.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 0);

require_once '../controllers/historical/controller.php';
require_once '../controllers/followers/controller.php';

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

            alert(null, '') ?>
        </main>
        <?php include_once '../structure/footer.php' ?>
    </section>
</body>

</html>