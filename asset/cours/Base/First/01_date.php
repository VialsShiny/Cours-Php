<?php

// DATE \\
$CreateTitle('Date :', 'h1');

// Timestamp actuel
$code = <<<PHP
echo time();
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Timestamp actuel', 'h2', $code, $res);

// Date formatée (Jour, Mois, Année)
$code = <<<PHP
echo date('D.M.Y');
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Date formatée (D.M.Y)', 'h2', $code, $res);

// Date actuelle : Format jour.mois.année
$code = <<<PHP
echo 'Date actuelle : ' . date('d.m.y');
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Date actuelle (d.m.y)', 'h2', $code, $res);

// Date de la semaine prochaine
$code = <<<PHP
\$nextWeek = time() + (7 * 24 * 60 * 60);
echo 'Semaine prochaine : ' . date('d.m.Y', \$nextWeek);
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Semaine prochaine (d.m.Y)', 'h2', $code, $res);

// Mktime : Timestamp à minuit aujourd'hui
$code = <<<PHP
echo mktime(0, 0, 0, date('n'), date('j'), date('Y'));
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Mktime : minuit aujourd\'hui', 'h2', $code, $res);


