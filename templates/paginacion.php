<?php if (!isset($_GET["buscar"]) || empty($_GET["buscar"])) {
    $totalPag = ceil($totalItems / $numItemsPag);

?>
    <div class="paginacion center">
        <?php
        if ($totalPag > 1) {
            for ($i = 1; $i <= $totalPag; $i++) {
                if ($pagina == $i) {
        ?> <a class="currentPag"><?= $i ?></a>
                <?php } else { ?>
                    <a href='<?= $urlA ?>pagina=<?= $i ?>'><?= $i ?></a>
            <?php
                }
            }
         } ?>
    </div>
<?php 
    } ?>