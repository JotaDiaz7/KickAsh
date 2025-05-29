<div class="flex end">
    <div class="searchWrap">
        <input type="text" name="search" id="search" placeholder="Buscar usuario" data-url="/controllers/followers/search.php" data-type="follows"/>
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
                    <span  class="nameT"><?= $user['name'] ?></span>

                </a>
                <div class="td flex end">
                    <button class="buttonF center" data-id="<?= $user['id'] ?>" data-follow="0">
                        Dejar de seguir
                    </button>
                </div>
            </div>

        <?php } ?>
    </div>
</div>
<?php include_once '../templates/paginacion.php' ?>