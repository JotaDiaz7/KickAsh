<div class="popupInfo flex">
    <div class="popupImgWrap center">
        <img src="/media/retos/<?= $data['img'] ?>" alt="<?= $data['name'] ?>" title="<?= $data['name'] ?>">
    </div>
    <div class="center g1 column">
        <h3>¡Enorabuena!</h3>
        <p class="tc">
            Has conseguido un nuevo reto
        </p>
        <p class="tc fw">
           <?= $data['name'] ?> 
        </p>
    </div>
</div>
<div class="popupButtons flex around">
    <a href="?retos" class="button confirm">Más retos</a>
    <a href="/cuenta" class="button cancel">Cerrar</a>
</div>