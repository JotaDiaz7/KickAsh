<?php
require_once '../config/head.php';

require_once '../config/seguridad.php';

//Establecemos conexión
$con = conectar_db();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once '../structure/head.php' ?>
    <link rel="stylesheet" href="/styles/coorp.css">
    <script type="module" src="/js/usuario.js"></script>
    <meta name="robots" content="index, follow">
    <title>KickAsh</title>
</head>

<body>
    <section id="root">
        <?php include_once '../structure/header.php' ?>
        <main >
            <?php if(isset($_GET['terms'])){
                include_once '../templates/term&cond.php';
            }else if(isset($_GET['privacy'])){
                include_once '../templates/priv&cookies.php';
            }else if(isset($_GET['ayuda'])){
                include_once '../templates/ayuda.php';
            }else{
                include_once '../templates/kickash.php';
            } ?>
        </main>
        <?php include_once '../structure/footer.php' ?>
    </section>
</body>

</html>