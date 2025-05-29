<div class="table retos">
    <div class="thead">
        <div class="th">img</div>
        <div class="th">Reto</div>
        <div class="th">Score</div>
        <div class="th">Activo</div>
    </div>
    <div class="tbody">
        <?php foreach ($data as $retos) { ?>
            <a class="tr " href="?reto=<?= $retos['id'] ?>">
                <div class="td center">
                    <span class="imgT">
                        <img src="<?= isset($retos['img']) && !empty($retos['img']) ? '/media/retos/' . $retos['img'] : '/media/logo/main.png' ?>" alt="Imagen reto" title="Imagen reto">
                    </span>
                </div>
                <div class="td center">
                    <?= $retos['name'] ?>
                </div>
                <div class="td center">
                    <?= $retos['score'] ?>
                </div>
                <div class="td center">
                    <span class="round <?= $retos['activo'] ? 'activo' : '' ?> "></span>
                </div>
            </a>
        <?php } ?>
    </div>
</div>
<?php if(isset($_GET['delete'])) alert(false, "Reto eliminado correctamente.");
include_once '../templates/paginacion.php';
?>