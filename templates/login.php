<form data-url="/controllers/user/login.php">
    <h3>Para menos humos...</h3>
    <div class="inputWrap">
        <label for="userL">Nombre de usuario o correo electrónico</label>
        <input type="text" name="user" id="userL" />
    </div>
    <div class="inputWrap flex between">
        <label for="passL">Contraseña</label>
        <input type="password" name="password" id="passL" />
        <button class="passButton">
            <img src="/media/icons/pass.svg" alt="Botón contraseña">
        </button>
    </div>
    <div class="flex checkWrap">
        <label for="checkL" class="toggleCheckbox">
            <input type="checkbox" id="checkL" name="checkbox" />
            <span class="check"></span>
            Recuérdame
        </label>
    </div>
    <div class="buttonWrap">
        <div class="loading-dots d-n">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <input type="submit" class="button" value="Inicia sesión" />
    </div>
</form>
<div class="toggleWrap tc">
    <button class="toggleForm" data-temp="register.php">¿Aún no tienes cuenta? ¡Regístrate!</button>
    <button class="toggleForm" data-temp="recover.php">¿Has olvidado tu contraseña?</button>
</div>