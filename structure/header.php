<header class="flex between">
    <div class="hw center">
        <?php imgUser($con, $idUser, true) ?>
        <a href="/mi-perfil" class="idWrap fw" title="Mi perfil"><?= $idUser ?></a>
    </div>
    <div class="flex">
            <a href=<?= $rolUser >= 1 ? "/admin" : "/cuenta" ?> title="Menú principal" class="center">
                <img src="/media/icons/menu-admin.svg" alt="Menú principal" class="icon">
            </a>
    </div>
</header>