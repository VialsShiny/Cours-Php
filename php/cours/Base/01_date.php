<?php

// DATE \\

$CreateTitle('DATE', 'h2');

// Affichage du code
$code = <<<'EOD'
// Affichage du timestamp actuel
echo time() . '<br>';

// Affichage de la date au format 'Jour.Mois.An'
echo date('D.M.Y') . '<br>';

// Affichage de la date actuelle au format 'Jour.Mois.An'
echo 'Date actuelle : ' . date('d.m.y') . '<br>';

// Calcul de la date de la semaine prochaine
$nextWeek = time() + (7 * 24 * 60 * 60);
echo 'Semaine prochaine : ' . date('d.m.Y', $nextWeek) . '<br>';

// Affichage d'une date avec mktime()
echo mktime(0, 0, 0, date('n'), date('j'), date('Y'));
EOD;
$CreateCodeZone($code);

// Exécution du code PHP
debug($code);

echo '<hr>';

