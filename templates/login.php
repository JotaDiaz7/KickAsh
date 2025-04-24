<form id="login">
    <h3>Para menos humos...</h3>
    <div class="inputWrap">
        <label for="userL">Nombre de usuario o correo electrónico</label>
        <input type="text" name="user" id="userL" />
    </div>
    <div class="inputWrap">
        <label for="passL">Contraseña</label>
        <input type="password" name="password" id="passL" />
    </div>
    <div class="flex checkWrap">
        <label for="checkL" class="toggleCheckbox">
            <input type="checkbox" id="checkL" name="checkbox" />
            <span class="check"></span>
            Recuérdame
        </label>
    </div>
    <input type="submit" class="button" value="Inicia sesión" />
    <div class="registerWrap">
        <button class="toggleForm">¿Aún no tienes cuenta? ¡Regístrate!</button>
    </div>
</form>
<form id="register" class="d-n">
    <h3>Para menos humos...</h3>
    <div class="inputWrap">
        <label for="userR">Nombre de usuario</label>
        <input type="text" name="user" id="userR" />
    </div>
    <div class="inputWrap">
        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" />
    </div>
    <div class="inputWrap">
        <label for="passR">Contraseña</label>
        <input type="password" name="password" id="passR" />
    </div>
    <div class="flex checkWrap">
        <label for="checkR" class="toggleCheckbox">
            <input type="checkbox" id="checkR" name="checkbox"/>
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
    <div class="registerWrap">
        <button class="toggleForm">¿Ya tienes una cuenta? !Inicia sesión!</button>
    </div>
</form>