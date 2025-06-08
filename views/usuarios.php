<div class="table">
    <div class="thead">
        <div class="th">img</div>
        <div class="th">id</div>
        <div class="th d-ns">Nivel</div>
        <div class="th">Rol</div>
        <div class="th">Activo</div>
    </div>
    <div class="tbody">
        <?php foreach ($data as $user) { 
            $podium = $model->getUserPodiumPosition($con, $user['id']);
            ?>
            <a class="tr " href="?user=<?= $user['id'] ?>">
                <div class="td center">
                    <span class="imgT">
                        <img src="<?= isset($user['img']) && !empty($user['img']) ? '/media/users/' . $user['img'] : '/media/logo/main.svg' ?>" alt="Imagen usuario" title="Imagen usuario">
                    </span>
                </div>
                <div class="td center">
                    <?= $user['id'] ?>
                </div>
                <div class="td d-ns tc">
                    <?= $podium ?>
                </div>
                <div class="td center">
                    <span><?= $user['rol'] == 0 ? 'Usuario' : 'Administrador' ?></span>
                </div>
                <div class="td center">
                    <span class="round <?= $user['activo'] ? 'activo' : '' ?> "></span>
                </div>
            </a>
        <?php } ?>
    </div>
</div>
<?php include_once '../templates/paginacion.php' ?>