<form>
    <h3 class="tc">Cigarrillos</h3>
    <div>
        <div class="inputWrap">
            <label for="smoke_time">Años fumando</label>
            <input type="text" name="smoke_time" id="smoke_time" maxlength="100" value="<?= $data['smoke_time'] ?>" readonly />
        </div>
        <div class="inputWrap">
            <label for="num_cig_day">Cig. por día</label>
            <input type="text" name="num_cig_day" id="num_cig_day" maxlength="100" value="<?= $data['num_cig_day'] ?>" readonly />
        </div>
    </div>
</form>
<form class="form" data-url="/controllers/user/infoCig.php">
    <h3>Compras</h3>
    <div class="inputWrap">
        <label for="price_cig">Precio</label>
        <input type="text" name="price_cig" id="price_cig" maxlength="100" value="<?= $data['price_cig'] ?>" />
    </div>
    <div class="inputWrap">
        <label for="num_cig">Num. cigarrillos</label>
        <input type="text" name="num_cig" id="num_cig" maxlength="100" value="<?= $data['num_cig'] ?>" />
    </div>
    <div class="flex end">
        <div class="buttonWrap">
            <div class="loading-dots d-n">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <input type="submit" class="button" value="Actualizar" />
        </div>
    </div>
</form>