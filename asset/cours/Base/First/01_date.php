<?php

// DATE \\

echo time() . '<br>';

echo date('D.M.Y') . '<br>';

echo 'Date actuelle : ' . date('d.m.y') . '<br>';

$nextWeek = time() + (7 * 24 * 60 * 60);

echo 'Semaine prochaine : ' . date('d.m.Y', $nextWeek) . '<br>';

echo mktime(0, 0, 0, date('n'), date('j'), date('Y'));