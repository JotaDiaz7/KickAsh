<header class="flex between">
    <div class="hw center">
        <?php
        if (isset($idUser)) {
            imgUser($con, $idUser, true)
        ?>
            <a href="/mi-perfil" class="idWrap fw" title="Mi perfil"><?= $idUser ?></a>
        <?php } else { ?>
            <img src="../media/logo/mainLogo.svg" alt="Main logo" class="mainLogo" title="Main logo" width="100px">
        <?php } ?>
    </div>
    <div class="flex alignCenter g2">
        <?php
        if (isset($idUser)) {

            $countRetos = countRetosUser($con, $idUser);
            if (!isset($_GET['retos']) && $rolUser == 0 && $countRetos > 0) {
        ?>
                <a href="/cuenta?retos" title="Retos">
                    <img src="../media/icons/retos.PNG" width="50px" class="retosH" alt="Retos enlace" title="Retos enlace">
                </a>
            <?php } ?>
            <a href=<?= $rolUser >= 1 ? "/admin" : "/cuenta" ?> title="Menú principal" class="center">
                <img src="/media/icons/menu-admin.svg" alt="Menú principal" class="icon">
            </a>
        <?php } else { ?>
            <a href="/" title="Menú principal" class="center">
                <img src="/media/icons/menu-admin.svg" alt="Menú principal" class="icon">
            </a>
        <?php } ?>
    </div>
</header>