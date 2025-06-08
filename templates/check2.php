<div class="mainWrap c-r center">
    <div class="logoWrap center">
        <img src="/media/logo/check2.png" alt="Question logo" title="Question logo">
    </div>
    <div class="infoWrap ">
        <h1>Dos preguntas más...</h1>
        <form data-url="/controllers/user/infoCig.php">
            <p>Cuando compras tabaco, ¿cuánto dinero sueles gastar en cada compra? (ya sea en paquetes, cartones, etc.)</p>
            <div class="inputWrap">
                <label for="precio">Precio</label>
                <input type="text" name="precio" id="precio" maxlength="5" />
            </div>
            <p>¿Y cuántos cigarrillos vienen en cada compra? (ya sea en paquetes, cartones, etc.)</p>
            <p>*En caso de usar tabaco de liar, dinos más o menos cuántos cigarrillos te salen...</p>
            <div class="inputWrap">
                <label for="cigs">Cigarrillos</label>
                <input type="text" name="cigs" id="cigs" maxlength="3" />
            </div>
            <div class="buttonWrap">
                <div class="loading-dots d-n">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <input type="submit" class="button" value="Guardar y continuar" />
            </div>
        </form>
    </div>
</div>
<?php include_once 'alert.php' ?>