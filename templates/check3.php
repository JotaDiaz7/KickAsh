<div class="mainWrap c-r center">
    <div class="logoWrap center">
        <img src="/media/logo/happy.svg" alt="Happy logo" title="Happy logo">
    </div>
    <div class="infoWrap ">
        <h1>¡Y ya por último!</h1>
        <form data-url="/controllers/user/infoCig2.php">
            <p>Más o menos, ¿cuántos años llevas fumando?</p>
            <p>*En caso de llevar menos de un año, introduce 1.</p>
            <div class="inputWrap">
                <label for="years">Años</label>
                <input type="text" name="years" id="years" maxlength="2" />
            </div>
            <p>¿Cuál sería el promedio de cigarrillos que fumas al día?</p>
            <div class="inputWrap">
                <label for="ncigs">Cigarrillos</label>
                <input type="text" name="ncigs" id="ncigs" maxlength="3" />
            </div>
            <div class="buttonWrap">
                <div class="loading-dots d-n">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <input type="submit" class="button" value="Guardar y finalizar" />
            </div>
        </form>
    </div>
</div>
<?php include_once 'alert.php' ?>