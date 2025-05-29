<?php
session_start();

require_once './config/seguridad.php';

seguridad(false, -1)

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once './structure/head.php' ?>
    <link rel="stylesheet" href="/styles/index.css">
    <script type="module" src="/js/index.js"></script>
    <title>KickAsh</title>
</head>

<body>
    <section id="root">
        <main class="flex">
            <div class="logoWrap center column">
                <div class="imgWrap relative">
                    <img src="./media/logo/mainLogo.svg" alt="Logo KiskAsh" title="Logo KiskAsh" />
                </div>
            </div>
            <div class="formWrap relative center column">
                <div class="tempWrap">
                    <?php include_once './templates/login.php' ?>
                </div>
                <?php include_once './templates/alert.php' ?>
            </div>
        </main>
        <?php include_once './structure/footer.php' ?>
    </section>
</body>

</html>