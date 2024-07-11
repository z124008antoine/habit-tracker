<?php
// size: square number, direction: 1, -1
function line($size, $direction) {
    for ($i = 0; $i < $size; $i++) {
        ?>
        <div class="square" style="transform: translateY(<?= $i * $direction * 100; ?>%); transition-delay: <?= $i * 50 ?>ms;"></div>
        <?php
    }
}
?>

<button class="hamburger open">
    <div class="line">
        <?= line(7, 1); ?>
    </div>
    <div class="line middle">
        <?= line(7, 0); ?>
    </div>
    <div class="line">
        <?= line(7, -1); ?>
    </div>
</button>

<script defer>
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('nav');

    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        nav.classList.toggle('active');
    });
</script>