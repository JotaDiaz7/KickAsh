<form class="first center column" data-url="/controllers/user/changeImgUser.php">
    <div class="imgWrap">
        <label for="imgInput" class="center">
            <img id="img" src="<?= isset($data['img']) && !empty($data['img']) ? '/media/users/' . $data['img'] : '/media/logo/main.svg' ?>">
        </label>
    </div>
    <input type="file" id="imgInput" name="img" aria-label="Archivo" class="hidden inputImg" accept="image/png, image/jpg, image/jpeg">
    <div class="buttonWrap tc">
        <div class="loading-dots d-n">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <input type="submit" class="button" value="Actualizar imagen" />
    </div>
</form>