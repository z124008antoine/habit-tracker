<?php

function pixel_mask($width, $id) {
    $pixel_size = 100/$width . "vw";
    $height = 3 * $width;
    echo "<div id='$id' class='pixel-mask' style='grid-template-columns: repeat($width, $pixel_size); grid-template-rows: repeat($height, $pixel_size);'>";
    for ($j = 0; $j < $height; $j++) {
        for ($i = 0; $i < $width; $i++) {
            $transitionDelay = 300 + rand(0, 1000) . "ms";
            echo "<div class='mask-pixel' style='transition-delay: $transitionDelay'></div>";
        }
    }
    echo "</div>";
}
