<?php
$clase = '';
if (isset($error)) {
    $clase = $error ? 'displayAlert error' : 'displayAlert success';
}
?>
<div id="alert" class="alert flex <?= $clase ?>">
    <p class="fw"><?= $message ?? '' ?></p>
    <span class="fw">X</span>
</div>