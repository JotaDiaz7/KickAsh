<div>
    <?php $countRetos = countRetosUser($con, $idUser) ?>
    <h2 class="tc"><?= $countRetos > 0 ? 'Retos' : 'No hay retos disponibles' ?></h2>
</div>
<div class="retos flex g2 wrap center">
    <?php foreach ($data as $reto) { ?>
        <div class="retoWrap">
            <a href="?reto=<?= $reto['id'] ?>" class="retoLink">
                <img src="<?= '/media/retos/' . $reto['img'] ?>" alt="<?= $reto['name'] ?>" title="<?= $reto['name'] ?>">
            </a>
        </div>
    <?php } ?>
</div>