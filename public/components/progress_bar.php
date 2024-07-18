<?php
function renderBar($val, $max_val, $id) {
    $percentage = ($val / $max_val) * 94;
    ?>
<div id="<?=$id?>" class="progress-bar">
    <img src="/images/ui/progressbar.png" alt="blue progress bar">
    <div class="progress-bar-mask" style="width: <?= 100 - $percentage ?>%"></div>
    <div class="progress-bar-text"><?= $val ?> / <?= $max_val ?></div>
</div>
<?php
}