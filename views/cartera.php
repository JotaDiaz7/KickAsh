<div class="tempImgWrap center">
    <img src="/media/logo/cartera.png" alt="Cartera logo" title="Cartera logo">
</div>
<div class="tempWrap r-cm">
    <?php if ($data['total'] >= 1) { ?>
        <h2>¡Increíble!</h2>
        <p>Desde el <?= $data['date_r'] ?>, llevas un ahorro diario de <span class="fw"><?= $data['avg'] ?></span>€.</p>
        <p>Y ya llevas ahorrado en <span class="cartera fw">tu cartera</span>.</p>
        <p class="savings tc"><span class="fw"><?= $data['total'] ?></span>€</p>
    <?php } else { ?>
        <h2>¡Empieza a ahorrar!</h2>
        <p>Fuma menos de lo habitual y convierte cada cigarro no fumado en euros para ti.</p>
        <p>Menos humo, más pasta. Tu cartera lo nota antes que tus pulmones.</p>

    <?php } ?>
</div>