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
    <link rel="stylesheet" href="/styles/mi-perfil.css">
    <script type="module" src="/js/mi-perfil.js"></script>
    <title>KickAsh</title>
</head>

<body>
    <section id="root">
        <?php include_once '../structure/header.php' ?>
        <main>
            <?php if(isset($_GET['delete']) && $rolUser == 0){
                include_once '../templates/delete.php';
            }else if (isset($_GET['img'])) { ?>
                <h1>Cambiar imagen</h1>
            <?php imgUser($con, $idUser, false);
            } else { ?>
                <h1>Mi perfil</h1>
                <div class="mainWrap flex between">
                    <div class="infoWrap flex">
                        <?php if (!isset($_GET['data'])) { ?>
                            <?php dataUser($con, $idUser) ?>
                            <form class="form" data-controller="password">
                                <h3>Contraseña</h3>
                                <div class="inputWrap flex between">
                                    <label for="pass">Nueva contraseña</label>
                                    <input type="password" name="pass" id="pass" />
                                    <button class="passButton">
                                        <img src="/media/icons/pass.svg" alt="Botón contraseña">
                                    </button>
                                </div>
                                <div class="inputWrap flex between">
                                    <label for="passR">Repetir contraseña</label>
                                    <input type="password" name="passR" id="passR" />
                                    <button class="passButton">
                                        <img src="/media/icons/pass.svg" alt="Botón contraseña">
                                    </button>
                                </div>
                                <div class="flex end">
                                    <input type="submit" class="button" value="Actualizar" />
                                </div>
                            </form>
                        <?php } else {
                            dataUser2($con, $idUser);
                        } ?>
                    </div>
                    <aside class="flex between">
                        <nav>
                            <ul>
                                <li class="d-nm">
                                    <a href="/mi-perfil?img" title="Cambiar imagen">Cambiar imagen</a>
                                </li>
                                <?php if ($rolUser == 0) { ?>
                                    <li class="d-nm">
                                        <a href="/cuenta?cartera" title="Mi cartera">Mi cartera</a>
                                    </li>
                                    <li class="d-nm">
                                        <a href="<?php echo !isset($_GET['data']) ? '/mi-perfil?data' : '/mi-perfil'; ?>" title="Más datos">Más datos</a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="/controllers/user/logout.php" title="Cerrar sesión">Cerrar sesión</a>
                                </li>
                            </ul>
                        </nav>
                        <?php if ($rolUser == 0) { ?>
                            <a class="delete center" href="?delete">Desactivar cuenta</a>
                        <?php } ?>
                    </aside>
                </div>

            <?php } ?>
            <?php include_once '../templates/alert.php' ?>
        </main>
        <?php include_once '../structure/footer.php' ?>
    </section>
</body>

</html>