<div class="popupInfo flex">
    <div class="popupImgWrap center">
        <img src="/media/logo/main.svg" alt="Pregunta logo" title="Pregunta logo">
    </div>
    <div class="center">
        <p class="tc">
            ¿Estás seguro que quieres <?= $_GET['activo'] == 1 ? "desactivar" : "activar"?> <?= isset($_GET['reto']) ? "este reto" : "a este usuario" ?>?
        </p>
    </div>
</div>
<div class="popupButtons flex around">
    <button class="button confirm" data-url="/controllers/<?= isset($_GET['reto']) ? "retos" : "user"  ?>/changeActive.php?activo=<?= $_GET['activo'] == 1 ? 0 : 1?>&id=<?= $_GET['id'] ?>"><?= $_GET['activo'] == 1 ? "Desactivar" : "Activar"?></button>
    <button class="button cancel">Cancelar</button>
</div>