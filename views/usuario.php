<?php
$user = $_SESSION["user"] ?? (isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"], true) : null);
$userId = $user['id'];
$check = $id == $userId;
if ($check) {
    checkRegister($con, $userId); //En caso de que no haya ningún registro de hoy, vamos a crearlo
    checkRetos($con, $userId); //Comprobamos si el usuario tiene retos
} else {
    $follow = $modelF->checkFollow($con, $userId, $id); //Comprobamos si el usuario sigue al usuario que está viendo
}
$hist = $modelH->getRegister($con, $id); //Lo ponemos aquí para que no haya problemas a la hora de encontrar el registro del día de hoy
$podium = $model->getUserPodiumPosition($con, $id);
$logros = $modelR->getLogros($con, $id);
$followers = $modelF->countFollowers($con, $id);
$follows = $modelF->countFollows($con, $id);

if (!$check) { ?>
    <div class="first flex between">
        <h1><?= $id ?></h1>
        <button class="buttonFollow buttonF center" data-id="<?= $id ?>" data-follow="<?= $follow ? 0 : 1 ?>">
            <?= $follow ? 'Dejar de seguir' : 'Seguir' ?>
        </button>
    </div>
<?php }

if (isset($_GET['followers'])) {
    getFollowers($con, $id);
} else if (isset($_GET['follows'])) {
    getFollows($con, $id);
} else {
?>
    <div class="second flex between">
        <div class="infoWrap flex g2">
            <?php if (!$check) { ?>
                <div class="imgWrap">
                    <img src="<?= !empty($data['img']) ? '/media/users/' . $data['img'] : '/media/logo/main.svg'; ?>" alt="Imagen usuario" title="Imagen usuario">
                </div>
            <?php } ?>
            <div class="dataWrap">
                <h3><?= $data['name'] ?></h3>
                <div class="flex g5">
                    <a <?= $check ? 'href="?followers"' : '' ?> title="Enlace a los seguidores">
                        <div>
                            <p id="followers" class="tc"><?= $followers ?? 0 ?></p>
                            <p>seguidores</p>
                        </div>
                    </a>
                    <a <?= $check ? 'href="?follows"' : '' ?>  title="Enlace a los seguidos">
                        <div>
                            <p id="follows" class="tc"><?= $follows ?? 0 ?></p>
                            <p>seguidos</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="iconsWrap flex">
            <a href="/cuenta?podium" class="iconWrap center" alt="Enlace al podium" title="Enlace al podium">
                <div>
                    <p class="tc"><?= $podium ?></p>
                    <p>podium</p>
                </div>
                <img src="../media/icons/podium.png" alt="Podium">
            </a>
            <a <?php if ($check) { ?> href="?historico" <?php } ?> title="Enlace a mi histórico" class="iconWrap center">
                <div>
                    <p class="tc"><?= $hist['rachas'] ?? 0 ?></p>
                    <p>rachas</p>
                </div>
                <img src="../media/icons/racha.png" alt="Racha">
            </a>
            <?php if ($check) { ?>
                <a href="?cartera" title="Enlace a mi cartera" class="iconWrap center ">
                    <div>
                        <p class="tc"><span id="save"><?= $hist['money'] > 0 ? $hist['money'] : 0 ?></span>€</p>
                        <p>ahorrado</p>
                    </div>
                    <img src="../media/icons/money.png" alt="Money">
                </a>
            <?php } ?>
        </div>
    </div>
    <?php if ($check && isset($_GET['historico'])) {
        getHist($con, $id, $_GET['historico']);
    } else if (isset($_GET['podium'])) {
        getPodium($con, $userId);
    } else { ?>
        <div class="third flex wrap">
            <?php
            alert(null, '');
            if ($check && isset($_GET['cartera'])) {
                getCartera($con, $id);
            } else if (isset($_GET['reto'])) {
                getRetoUser($con, $_GET['reto'], $userId);
            } else { ?>
                <div class="cigWrap center">
                    <img src="/media/icons/cigs.png" class="cigImg" alt="Cantidad cigarrillos" title="Cantidad cigarrillos">
                    <div class="cantWrap flex g1">
                        <?php if ($check) { ?>
                            <button class="buttonCant center" data-url="plus" data-max="<?= $data['num_cig_day'] ?>">
                                <img src="/media/icons/plus.svg" alt="Botón para sumar cigarrillos" title="Botón para sumar cigarrillos">
                            </button>
                        <?php } ?>
                        <span id="cantCig" class="<?= $hist['num_cig'] >= $data['num_cig_day'] ? 'errorC' : '' ?>"><?= $hist['num_cig'] ?? 0 ?></span>
                        <?php if ($check) { ?>
                            <button class="buttonCant center" data-url="minus" data-max="<?= $data['num_cig_day'] ?>">
                                <img src="/media/icons/minus.svg" alt="Botón para restar cigarrillos" title="Botón para restar cigarrillos">
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <div class="amountWrap flex between">
                    <?php calculadora($con, $id);
                    if (!empty($logros)) { ?>
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
                    <?php } ?>
                </div>
            <?php }
            ?>
        </div>
<?php }
} ?>