<div>
    <h3>Mis datos</h3>
    <div class="flex column g3">
        <form data-controller="name" class="form">
            <div class="inputWrap">
                <label for="name">Nombre</label>
                <input type="text" name="nameD" id="name" maxlength="100"  value="<?= $data['name'] ?>"/>
            </div>
            <div class="flex end">
                <input type="submit" name="subData" class="button" value="Actualizar" />
            </div>
        </form>
        <form data-controller="email" class="form">
            <div class="inputWrap">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" id="email" maxlength="100" value="<?= $data['email'] ?>" />
            </div>
            <div class="flex end">
                <input type="submit" class="button" value="Actualizar" />
            </div>
        </form>
    </div>
</div>