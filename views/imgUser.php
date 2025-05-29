<form id="imgForm" class="first center column">
    <div class="imgWrap">
        <label for="imgInput" class="center">
            <img id="img" src="<?= isset($data['img']) && !empty($data['img']) ? '/media/users/' . $data['img'] : '/media/logo/main.svg' ?>">
        </label>
    </div>
    <input type="file" id="imgInput" name="img" aria-label="Archivo" class="hidden inputImg" accept="image/png, image/jpg, image/jpeg">
    <input type="submit" class="button" value="Actualizar imagen" />
</form>