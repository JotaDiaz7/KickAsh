<div class="popupInfo flex">
    <div class="popupImgWrap center">
        <img src="/media/logo/main.svg" alt="Pregunta logo" title="Pregunta logo">
    </div>
    <div class="center">
        <p class="tc">
            ¿Estás seguro que quieres hacer <?= $_GET['rol'] == 1 ? "administrador" : "usuario"?> a <?= $_GET['id'] ?> ?
        </p>
    </div>
</div>
<div class="popupButtons flex around">
    <button class="button confirm" data-url="/controllers/user/changeRol.php?rol=<?= $_GET['rol'] ?>&id=<?= $_GET['id'] ?>">Cambiar</button>
    <button class="button cancel">Cancelar</button>
</div>