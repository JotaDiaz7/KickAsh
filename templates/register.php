<form data-url="registro.php">
    <h3>Para menos humos...</h3>
    <div class="inputWrap">
        <label for="userR">Nombre de usuario</label>
        <input type="text" name="user" id="userR" maxlength="20" />
    </div>
    <div class="inputWrap">
        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" maxlength="100" />
    </div>
    <div class="inputWrap flex between">
        <label for="passR">Contraseña</label>
        <input type="password" name="password" id="passR" />
        <button class="passButton">
            <img src="/media/icons/pass.svg" alt="Botón contraseña">
        </button>
    </div>
    <div class="flex checkWrap">
        <label for="checkR" class="toggleCheckbox">
            <input type="checkbox" id="checkR" name="checkbox" />
            <span class="check"></span>
            Aceptas nuestra
            <a href="#" title="política de privacidad" class="fw">
                política de privacidad
            </a>
            y
            <a href="#" title="política de cookies" class="fw">
                de cookies.
            </a>
        </label>
    </div>
    <input type="submit" class="button" value="Regístrate" />
</form>
<div class="toggleWrap tc">
    <button class="toggleForm" data-temp="login.php">¿Ya tienes una cuenta? !Inicia sesión!</button>
</div>