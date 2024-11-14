<?php

// EXOS :
// Exercice 2
$CreateTitle('Exercice 2:', 'h1');

// 2.1
$code = <<<PHP
\$tab1 = array();
for (\$i = 1; \$i <= 10; \$i++) {
    array_push(\$tab1, \$i);
}

\$tab2 = array();
for (\$i = 10; \$i <= 20; \$i++) {
    array_push(\$tab2, \$i);
}

\$tabF = array();
for (\$i = 0; \$i <= 9; \$i++) {
    array_push(\$tabF, \$tab1[\$i] + \$tab2[\$i]);
}

var_dump(\$tabF);
PHP;

ob_start();
eval ($code);
$res = ob_get_clean();
$CreateCodeExemple('2.1', 'h4', $code, $res);

// 2.2
$code = <<<PHP

\$tabRandom = array();
for (\$i = 0; \$i <= 9; \$i++) {
    array_push(\$tabRandom, rand(1, 100));
}
sort(\$tabRandom);
\$newTab = implode(' ; ', \$tabRandom);
var_dump(\$newTab);
PHP;

ob_start();
eval ($code);
$res = ob_get_clean();
$CreateCodeExemple('2.2', 'h4', $code, $res);

// 2.3
$code = <<<PHP

include '01_tab.inc.php';
PHP;

ob_start();
eval ($code);
$res = ob_get_clean();
$CreateCodeExemple('2.3', 'h4', $code, $res);

// 2.4
$code = <<<PHP
\$arr1 = array(6, 25, 35, 61);
\$arr2 = array(12, 24, 46);
\$result = 0;

foreach (\$arr2 as \$x) {
    for (\$i = 0; \$i < count(\$arr1); \$i++) {
        \$result += \$x * \$arr1[\$i];
    }
}

echo \$result;
PHP;

ob_start();
eval ($code);
$res = ob_get_clean();
$CreateCodeExemple('2.4', 'h4', $code, $res);

// 2.5
$code = <<<PHP

\$imgArray = array();
\$url = "https://api.thecatapi.com/v1/images/search?size=med&mime_types=jpg&format=json&has_breeds=true&order=RANDOM&page=0&limit=1";

for (\$i = 0; \$i < 3; \$i++) {
    \$result = file_get_contents(\$url);
    \$result = json_decode(\$result, true);

    if (isset(\$result[0]['url'])) {
        \$imgArray[] = [
            'twitch.tv/el_vials',
            \$result[0]['url'],
            'Cat',
        ];
    }
}
    
foreach (\$imgArray as \$img) {
    echo "<img src=" . \$img[1] . " alt=" . \$img[2] . ">";
}
PHP;

ob_start();
eval ($code);
$res = ob_get_clean();
$CreateCodeExemple('2.5', 'h4', $code, $res);

