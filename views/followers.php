<div class="flex between alignCenter wrap g2 menuWrap">
    <div class="buttonsWrap flex g2">
        <a href="?followers" class="fw <?= isset($_GET['followers']) ? 'selec' : '' ?>">Seguidores</a>
        <a href="?follows" class="fw <?= isset($_GET['follows']) ? 'selec' : '' ?>">Seguidos</a>
    </div>
    <div class="searchWrap">
        <input type="text" name="search" id="search" placeholder="Buscar usuario" data-url="/controllers/followers/search.php" data-type="follower"/>
    </div>
</div>
<div class="table followers">
    <div class="tbody">
        <?php foreach ($data as $user) { ?>
            <div class="tr">
                <a class="tdF flex g1 alignCenter" href="/usuario?id=<?= $user['id'] ?>">
                    <span class="imgT">
                        <img src="<?= isset($user['img']) && !empty($user['img']) ? '/media/users/' . $user['img'] : '/media/logo/main.svg' ?>" alt="Imagen usuario" title="Imagen usuario">
                    </span>
                    <span class="nameT"><?= $user['name'] ?></span>
                </a>
                <div class="td flex end">
                    <button class="buttonFer center" data-id="<?= $user['id'] ?>">
                        Eliminar seguidor
                    </button>
                </div>
            </div>

        <?php } ?>
    </div>
</div>
<?php include_once '../templates/paginacion.php' ?>