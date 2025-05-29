<?php
require_once '../config/head.php';

//Establecemos conexión
$con = conectar_db();

seguridad(true, 1);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once '../structure/head.php' ?>
    <link rel="stylesheet" href="/styles/admin.css">
    <script type="module" src="/js/admin.js"></script>
    <title>KickAsh</title>
</head>

<body>
    <section id="root">
        <?php include_once '../structure/header.php' ?>
        <main>
            <div class="menu flex between g2 wrap">
                <div class="buttonsWrap flex g2">
                    <a href="/admin" class="fw <?= !isset($_GET['retos']) && !isset($_GET['reto']) && !isset($_GET['reg_reto']) ? 'selec' : '' ?>">Usuarios</a>
                    <a href="?retos" class="fw <?= isset($_GET['retos']) || isset($_GET['reto']) || isset($_GET['reg_reto']) ? 'selec' : '' ?>">Retos</a>
                </div>
                <?php if (isset($_GET['retos']) || isset($_GET['reto']) || isset($_GET['reg_reto'])) { ?>
                    <div class="flex">
                        <a href="?reg_reto" class="fw">Registrar reto</a>
                    </div>
                <?php } else if(!isset($_GET['retos']) && !isset($_GET['reto']) && !isset($_GET['reg_reto']) && !isset($_GET['user'])) { ?>
                    <div class="searchWrap">
                        <input type="text" name="search" id="search" placeholder="Buscar usuario" data-url="/controllers/user/search.php"/>
                    </div>
                <?php } ?>
            </div>
            <?php if (isset($_GET['user'])) {
                getUser($con, $_GET['user'], $rolUser);
            } else if (isset($_GET['retos'])) {
                getRetos($con);
            } else if (isset($_GET['reto'])) {
                getReto($con, $_GET['reto']);
            } else if (isset($_GET['reg_reto'])) {
                include_once '../templates/reg_reto.php';
            } else {
                getUsers($con);
            } ?>

        </main>
        <?php include_once '../structure/footer.php' ?>
    </section>
    <?php include_once '../templates/popup.php' ?>
</body>

</html>