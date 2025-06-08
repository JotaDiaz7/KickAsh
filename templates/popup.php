<div id="blackGround" class="center <?= !empty($logroC) ? 'showPop confeti' : '' ?>">
    <div id="popup" class="flex column between">
        <?php
        if (!empty($logroC)) popupLogro($con, $logroC)
        ?>
    </div>
</div>