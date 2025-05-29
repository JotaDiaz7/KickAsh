<div class="second flex">
    <form id="retoFrom" class="relative flex column between" data-controller="/controllers/retos/update.php">
        <div class="flex dataWrap">
            <div class="imgRetoWrap center">
                <label for="imgInput" class="flex column">
                    Imagen
                    <img id="img" src="/media/retos/<?= $data['img'] ?>">
                </label>
                <input type="hidden" name="img" value="<?= $data['img'] ?>" />
                <input type="file" id="imgInput" name="img" aria-label="Archivo" class="hidden inputImg">
            </div>
            <div class="flex wrap around inputsRetoWrap">
                <div class="inputWrap">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" value="<?= $data['name'] ?>" readonly />
                </div>
                <div class="inputWrap">
                    <label for="score">Puntuación</label>
                    <input type="text" name="score" id="score" maxlength="1" value="<?= $data['score'] ?>" />
                </div>
                <div class="inputWrap">
                    <label for="rachas">Rachas</label>
                    <input type="text" name="rachas" id="rachas" maxlength="3" value="<?= $data['rachas'] ?>" placeholder="-"/>
                </div>
                <div class="inputWrap">
                    <label for="ncigs">Cigarrillos</label>
                    <input type="text" name="ncigs" id="ncigs" maxlength="3" value="<?= $data['num_cig'] ?>" placeholder="-" />
                </div>
                <div class="inputWrap">
                    <label for="follow">Seguidores</label>
                    <input type="text" name="follow" id="follow" maxlength="3" value="<?= $data['followers'] ?>" placeholder="-" />
                </div>

                <div class="inputWrap">
                    <label for="podium">Podium</label>
                    <input type="text" name="podium" id="podium" maxlength="2" value="<?= $data['podium'] ?>" placeholder="-" />
                </div>
            </div>
        </div>
        <?php alert(null,'') ?>
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="flex between">
            <button class="fw popUp" data-temp="/views/deleteReto.php?id=<?= $id ?>">Eliminar reto</button>
            <input type="submit" class="button" value="Actualizar" />
            <button class="fw <?= $data['activo'] == 1 ? "desc" : "act" ?> popUp" data-temp="/views/changeAct.php?activo=<?= $data['activo'] ?>&id=<?= $id ?>&reto"><?= $data['activo'] == 1 ? "Desactivar" : "Activar" ?> reto</button>
        </div>
    </form>
</div>