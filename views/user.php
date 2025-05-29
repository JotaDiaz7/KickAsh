<?php
$podium = $model->getUserPodiumPosition($con, $id);
$hist = $modelH->getRegister($con, $id);
$logros = $modelR->getLogros($con, $id);
$followers = $modelF->countFollowers($con, $id);
$follows = $modelF->countFollows($con, $id);

?>
<div class="second flex between">
    <div class="infoWrap flex g2">
        <div class="imgWrap">
            <img src="<?= isset($data['img']) && !empty($data['img']) ? '/media/users/' . $data['img'] : '/media/logo/main.svg' ?>" alt="Imagen usuario" title="Imagen usuario">
        </div>
        <div class="dataWrap">
            <h3><?= $id ?> </h3>
            <div class="flex g5">
                <div>
                    <div>
                        <p class="tc"><?= $followers ?></p>
                        <p>seguidores</p>
                    </div>
                </div>
                <div>
                    <div>
                        <p class="tc"><?= $follows ?></p>
                        <p>seguidos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iconsWrap flex around">
        <div class="iconWrap center">
            <div>
                <p class="tc"><?= $podium ?></p>
                <p>podium</p>
            </div>
            <img src="../media/icons/podium.png" alt="Podium">
        </div>
        <div class="iconWrap center">
            <div>
                <p class="tc"><?= isset($hist['rachas']) ? $hist['rachas'] : 0 ?></p>
                <p>rachas</p>
            </div>
            <img src="../media/icons/racha.png" alt="Racha">
        </div>
    </div>
</div>
<div class="mainDivsWrap">
    <h3 class="tc">Datos generales</h3>
    <div class="center wrap divsWrap">
        <div class="inputWrap">
            <span>Nombre</span>
            <p><?= $data['name'] ?></p>
        </div>
        <div class="inputWrap">
            <span>Email</span>
            <p><?= $data['email'] ?></p>
        </div>
        <div class="inputWrap">
            <span>Fecha registro</span>
            <p><?= $data['date_r'] ?></p>
        </div>
        <div class="inputWrap">
            <span>Precio en compra</span>
            <p><?= $data['price_cig'] ?>€</p>
        </div>
        <div class="inputWrap">
            <span>Nº cig. compra</span>
            <p><?= $data['num_cig'] ?></p>
        </div>
        <div class="inputWrap">
            <span>Nº cig. por día</span>
            <p><?= $data['num_cig_day'] ?></p>
        </div>
        <div class="inputWrap">
            <span>Años fumando</span>
            <p><?= $data['smoke_time'] ?></p>
        </div>
    </div>
    <div class="logrosWrap">
        <h3 class="tc">Logros</h3>
        <div class=" center g1">
            <?php foreach ($logros as $logro) { ?>
                <a href="?reto=<?= $logro['id'] ?>">
                    <img src="/media/retos/<?= $logro['img'] ?>" alt="Logro <?= $logro['name'] ?>" title="Logro <?= $logro['name'] ?>" class="retoImg">
                </a>
            <?php } ?>
        </div>
    </div>
</div>
<?php alert(null, '') ?>
<div class="changeWrap flex between">
    <button class="fw <?= $data['activo'] == 1 ? "desc" : "act" ?> popUp" data-temp="/views/changeAct.php?activo=<?= $data['activo'] ?>&id=<?= $id ?>"><?= $data['activo'] == 1 ? "Desactivar" : "Activar" ?> usuario</button>
    <button class="fw popUp" data-temp="/views/changeRol.php?rol=<?= $data['rol'] == 1 ? '0' : '1' ?>&id=<?= $id ?>">Cambiar a <?= $data['rol'] == 1 ? 'usuario' : 'administrador' ?></button> 
</div>