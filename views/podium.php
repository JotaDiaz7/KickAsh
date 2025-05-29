<div class="table podium">
    <div class="thead">
        <div class="th">Posición</div>
        <div class="th">Img</div>
        <div class="th">Usuario</div>
        <div class="th">Score</div>
    </div>
    <div class="tbody">
        <?php
        $i = 1;
        foreach ($data as $user) { 
            $href = $idUser == $user['id'] ? '/cuenta' : '/usuario?id=' . $user['id'];
        ?>
            <a class="tr" href="<?= $href ?>">
                <div class="td center">
                    <?php if ($i == 1) { ?>
                        <img src="/media/icons/podium.png" width="45" alt="Medalla oro" title="Medalla oro">
                    <?php } else if ($i == 2) { ?>
                        <img src="/media/icons/plata.png" width="45" alt="Medalla oro" title="Medalla oro">
                    <?php } else if ($i == 3) { ?>
                        <img src="/media/icons/bronce.png" width="45" alt="Medalla oro" title="Medalla oro">
                    <?php }else{ echo $i; } $i++?>
                </div>
                <div class="td center">
                    <span class="imgT">
                        <img src="<?= isset($user['img']) && !empty($user['img']) ? '/media/users/' . $user['img'] : '/media/logo/main.svg' ?>" alt="Imagen usuario" title="Imagen usuario">
                    </span>
                </div>
                <div class="td center">
                    <?= $user['id'] ?>
                </div>
                <div class="td center">
                    <?= $user['total_score'] ?>
                </div>
            </a>
        <?php } ?>
    </div>
</div>