<div class="popupInfo flex">
    <div class="popupImgWrap center">
        <img src="/media/logo/main.svg" alt="Pregunta logo" title="Pregunta logo">
    </div>
    <div class="center popupTextWrap">
        <p class="tc">
            ¿Estás seguro que quieres eliminar este reto? Ten en cuenta que esta acción es irreversible.
        </p>
    </div>
</div>
<div class="popupButtons flex around">
    <button class="button confirm" data-url="/controllers/retos/delete.php?id=<?= $_GET['id'] ?>">Eliminar</button>
    <button class="button cancel">Cancelar</button>
</div>