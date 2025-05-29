<div class="flex inputDates">
    <span>Desde</span>
    <input type="date" id="dateS" min="2025-04-29" value="<?= $dateS ?>">
    <span>hasta</span>
    <input type="date" id="dateE" max="<?= date('Y-m-d') ?>" value="<?= $dateE ?>">
</div>
<div class="table">
    <div class="thead">
        <div class="th">Fecha</div>
        <div class="th">Cigarros</div>
        <div class="th">Dinero</div>
        <div class="th">Racha</div>
    </div>
    <div class="tbody">
        <?php foreach ($data as $user) { ?>
            <div class="tr">
                <div class="td center">	
                    <?= $user['date'] ?>
                </div>
                <div class="td center">
                    <?= $user['num_cig'] ?>
                </div>
                <div class="td center">
                    <?= $user['money'] ?>€
                </div>
                <div class="td center">
                    <?= $user['rachas'] ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include_once '../templates/paginacion.php' ?>