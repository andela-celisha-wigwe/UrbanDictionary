<?php
function nums()
{
    echo "The generator has started.\n";
    for ($i = 0; $i < 5; ++$i) {
        yield $i;
        echo "Yielded $i \n";
    }
    echo "The generator has ended.\n";
}

foreach (nums() as $v) { var_dump($v);};