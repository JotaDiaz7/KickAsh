<div class="second flex c-rm">
    <form id="retoFrom" class="relative flex column between" data-controller="/controllers/retos/registro.php">
        <div class="flex dataWrap c-r">
            <div class="imgRetoWrap center">
                <label for="imgInput" class="flex column">
                    Imagen
                    <img id="img" src="/media/logo/happy.svg">
                </label>
                <input type="file" id="imgInput" name="img" aria-label="Archivo" class="hidden inputImg">
            </div>
            <div class="flex wrap  around inputsRetoWrap relative">
                <div class="inputWrap">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" />
                </div>
                <div class="inputWrap">
                    <label for="score">Puntuación</label>
                    <input type="text" name="score" id="score" maxlength="1" value="1"/>
                </div>
                <div class="inputWrap">
                    <label for="rachas">Rachas</label>
                    <input type="text" name="rachas" id="rachas" maxlength="3" placeholder="-" />
                </div>
                <div class="inputWrap">
                    <label for="ncigs">Cigarrillos</label>
                    <input type="text" name="ncigs" id="ncigs" maxlength="3" placeholder="-" />
                </div>
                <div class="inputWrap">
                    <label for="follow">Seguidos</label>
                    <input type="text" name="follow" id="follow" maxlength="3" placeholder="-" />
                </div>

                <div class="inputWrap">
                    <label for="podium">Podium</label>
                    <input type="text" name="podium" id="podium" maxlength="2" placeholder="-" />
                </div>
            </div>
        </div>
        <?php include_once '../templates/alert.php' ?>

        <div class="center">
            <input type="submit" class="button" value="Registrar" />

        </div>
    </form>
</div>