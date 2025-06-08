<form data-url="/controllers/user/recover.php">
    <h3>No te preocupes</h3>
    <p>Introduce el correo electrónico con el que te registraste.</p>
    <p>Te enviaremos una contraseña temporal para que puedas iniciar sesión.</p>
    <div class="inputWrap">
        <label for="email">Correo electrónico</label>
        <input type="text" name="email" id="email" />
    </div>
    <div class="buttonWrap">
        <div class="loading-dots d-n">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <input type="submit" class="button" value="Recuperar contraseña" />
    </div>
</form>
<div class="toggleWrap tc">
    <button class="toggleForm" data-temp="login.php">¿Ya tienes tu contraseña? ¡Inicia sesión!</button>
</div>