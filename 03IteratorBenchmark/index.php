<?php

echo '<div style="width:1500px;margin:0 auto;">';
echo '<h2>Iterator benchmark test</h2>';

for ($size = 1000; $size < 50000000; $size *= 2) {
    echo '<p>Testing size: ' . $size . '</p>';

    $container = [];
    for ($i = 0; $i < $size; $i++) {
        $container[$i] = 1;
    }

    $s = microtime(true);
    foreach ($container as $key => $value) {
    }
    echo '<p>Size: ' . $size . ', foreach Dtime: ' . (microtime(true) - $s) * 1000 . ' ms</p>';

    $s1 = microtime(true);
    $objContainer = new ArrayObject($container);
    $itContainer = $objContainer->getIterator();
    while ($itContainer->valid()) {
       $itContainer->next();
    }
    echo '<p>Size: ' . $size . ', iterator Dtime: ' . (microtime(true) - $s1) * 1000 . ' ms</p>';
}

echo '</div>';
