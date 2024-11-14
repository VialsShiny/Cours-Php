<?php

$CreateTitle('Bases :', 'h1');


// Echo
$code = <<<PHP
echo "<p>Je suis gentil</p>";
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Echo', 'h2', $code, $res);

// Variable
$code = <<<PHP
\$le = 'le';
\$leCookie = "BG \$le Cookie";
echo \$leCookie;
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Variable', 'h2', $code, $res);

// Gettype
$code = <<<PHP
echo gettype(\$leCookie);
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Gettype', 'h2', $code, $res);

// Concaténation
$code = <<<PHP
\$leCookie = 'BG le Cookie';
echo \$leCookie . PHP_EOL . 'MAIS NAAAN';
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Concaténation', 'h2', $code, $res);

// Le += en Php (pour les String)
$code = <<<PHP
\$s = '(s)';
\$le = 'le';
\$le .= \$s;
\$leCookie = "BG \$le Cookie" . \$s;
echo \$leCookie;
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Le += en Php (pour les String)', 'h4', $code, $res);

// Const/Define
$code = <<<PHP
const CAPITALE = 'Paris';
define('CAPITALE2', 'Madrid');
echo CAPITALE . PHP_EOL . CAPITALE2;
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Const/Define', 'h2', $code, $res);

// Constante Magique (__Teste__)
$code = <<<PHP
echo __DIR__ . PHP_EOL . __FILE__ . PHP_EOL . __LINE__;
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Constante Magique (__Teste__)', 'h4', $code, $res);

// Exercice
$code = <<<PHP
\$bleu = 'Bleu';
\$blanc = 'Blanc';
\$rouge = 'Rouge';
\$tiret = '-';
echo \$bleu . \$tiret . \$blanc . \$tiret . \$rouge;
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Exercice', 'h2', $code, $res);

// Opérateur arithmétiques
$code = <<<PHP
\$nbr1 = 10;
\$nbr2 = 2;
echo \$nbr1 % \$nbr2 . PHP_EOL;
\$nbr1 *= (\$nbr2 + \$nbr1);
echo \$nbr1;
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Opérateur arithmétiques', 'h4', $code, $res);

// Condition
$code = <<<PHP
\$a = 10;
\$b = 5;
if (\$a > \$b) {
    echo 'true' . PHP_EOL;
} elseif (\$a == 8) {
    echo 'false' . PHP_EOL;
} else {
    echo 'Je sais pas chef' . PHP_EOL;
}
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Condition', 'h2', $code, $res);

// Fonctions prédéfinies
$code = <<<PHP
\$email = 'tvialatou@gmail.com';
echo strpos(\$email, '@');
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Fonctions prédéfinies', 'h2', $code, $res);

// Explode/Implode
$code = <<<PHP
\$strToExplode = 'Lorem je sais pas quoi';
\$tabToExplode = explode(' ', \$strToExplode);
var_dump(\$tabToExplode);
PHP;

ob_start();
eval($code);
$res = ob_get_clean();
$CreateCodeExemple('Explode/Implode', 'h4', $code, $res);

?>
