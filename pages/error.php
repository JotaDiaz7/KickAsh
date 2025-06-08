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
    <link rel="stylesheet" href="/styles/error.css">
    <script type="module" src="/js/cuenta.js"></script>
    <meta name="robots" content="noindex, nofollow">
    <title>KickAsh</title>
</head>

<body>
    <section id="root">
        <?php include_once '../structure/header.php' ?>
        <main class="flex c-r">
            <div class="wrapper tc">
                <img src="/media/logo/error.svg" alt="">
            </div>
            <div class="wrapper tc">
                <h1>¡Ups! Algo ha salido mal</h1>
                <p><?= isset($_GET['error']) && !empty($_GET['error']) ? $_GET['error'] : 'Página no encontrada.' ?></p>
            </div>
        </main>
        <?php include_once '../structure/footer.php' ?>
    </section>
</body>

</html>