<div class="stateWrap">
    <div class="stateImgWrap center">
        <?php
        $sumState = $calc['tar'] + $calc['nicotine'] + $calc['co'];
        if ($sumState < 5) {
            $src = "/media/logo/main.svg";
        } else if ($sumState > 5 && $sumState <= 40) {
            $src = "/media/logo/regular.svg";
        } else if ($sumState > 40 && $sumState <= 70) {
            $src = "/media/logo/bad.svg";
        } else if ($sumState > 70) {
            $src = "/media/logo/verybad.svg";
        }
        ?>
        <img id="imgState" src="<?= $src ?>" class="stateImg" alt="Main logo" title="Main logo">
    </div>
    <div class="stateInfoWrap">
        <p><span class="stateC"><?= $calc['tar'] ?></span>% alquitrán</p>
        <p><span class="stateC"><?= $calc['nicotine'] ?></span>% nicotina</p>
        <p><span class="stateC"><?= $calc['co'] ?></span>% monóxido de carbono</p>
    </div>
</div>