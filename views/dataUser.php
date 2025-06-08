<div>
    <h3 class="tc">Mis datos</h3>
    <div class="flex column g3">
        <form data-url="/controllers/user/name.php" class="form">
            <div class="inputWrap">
                <label for="name">Nombre</label>
                <input type="text" name="nameD" id="name" maxlength="100" value="<?= $data['name'] ?>" />
            </div>
            <div class="flex end">
                <div class="loading-dots d-n">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <input type="submit" name="subData" class="button" value="Actualizar" />
            </div>
        </form>
        <form data-url="/controllers/user/email.php" class="form">
            <div class="inputWrap">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" id="email" maxlength="100" value="<?= $data['email'] ?>" />
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
    </div>
</div>