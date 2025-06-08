<div class="tempImgWrap center">
    <img src="/media/retos/<?= $data['img'] ?>" alt="reto <?= $data['name'] ?>" title="reto <?= $data['name'] ?>">
</div>
<div class="tempWrap r-cm">
    <h2><?= $data['name'] ?></h2>
    <?php if ($data['es_logro']) { ?> <p class="fw successR">Reto conseguido</p> <?php } ?>
    <ul>
        <?php if ($data['rachas'] > 0 && $data['rachas'] != null) { ?> <li>Consigue un mínimo de <span class="fw"><?= $data['rachas'] ?> </span>rachas.</li> <?php } ?>
        <?php if ($data['num_cig'] > 1 && $data['num_cig'] != null) { ?> <li>Puedes fumar como mucho <span class="fw"><?= $data['num_cig'] ?> </span>cigarrillos al día durante la racha.</li> <?php } ?>
        <?php if ($data['num_cig'] == 1 && $data['num_cig'] != null) { ?> <li>Puedes fumar solo <span class="fw">1</span> cigarrillo al día durante la racha.</li> <?php } ?>
        <?php if ($data['num_cig'] == 0 && $data['num_cig'] != null) { ?> <li><span class="fw">No puedes fumar ningún cigarrillo durante la racha.</span></li> <?php } ?>
        <?php if ($data['followers'] > 0 && $data['followers'] != null) { ?> <li>Sigue al menos a <span class="fw"><?= $data['followers'] ?> </span> personas.</li> <?php } ?>
        <?php if ($data['podium'] > 1 && $data['podium'] != null) { ?> <li>Manténte entre los <span class="fw"><?= $data['podium'] ?> </span> primeros del podium.</li> <?php } ?>
        <?php if ($data['podium'] == 1 && $data['podium'] != null) { ?> <li>Consigue llegar al número <span class="fw"><?= $data['num_cig'] ?> </span> del podium.</li> <?php } ?>
    </ul>
    <?php if ($data['activo'] == 0) { ?> <p class="fw desR">Este reto no se encuentra disponible.</p> <?php } ?>
</div>