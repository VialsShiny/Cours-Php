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

print_r(\$tabF);
PHP;

ob_start();
try {
    eval($code);
} catch (Throwable $e) {
    echo "Erreur dans 2.1 : " . $e->getMessage();
}
$res = ob_get_clean();
$CreateCodeExemple('2.1', 'h3', $code, $res);

// 2.2
$code = <<<PHP
\$arrInfo = array(
    'DUPONT' => array(
        'Clé' => 'Valeur',
        'prénom' => 'PAUL',
        'profession' => 'Ministre',
        'age' => 50,
    ),
    'DURANT' => array(
        'Clé' => 'Valeur',
        'prénom' => 'ROBERT',
        'profession' => 'agriculteur',
        'age' => 45,
    )
);

?>
<table>
    <caption>PHP</caption>
    <tbody>
    <tr>
        <th scope="col">Clé</th>
        <th scope="col" colspan="2">Valeur</th>
    </tr>
    <?php
    foreach (\$arrInfo as \$key => \$valeur) {
        echo '<tr>';
        echo "<th scope=\\"row\\" rowspan=\\"5\\">\$key</th>";
        foreach (\$valeur as \$k => \$v) {
            if (\$k === "Clé") {
                echo '<td>' . \$k . '</td>';
            }
            if (\$v === "Valeur") {
                echo '<td>' . \$v . '</td>';
            }
        }
        echo '</tr>';
        foreach (\$valeur as \$k => \$v) {
            echo '<tr>';
            if (\$k !== "Clé") {
                echo '<td>' . \$k . '</td>';
            }
            if (\$v !== "Valeur") {
                echo '<td>' . \$v . '</td>';
            }
            echo '</tr>';
        }
    }
    ?>
    </tbody>
</table>
PHP;

ob_start();
try {
    eval($code);
} catch (Throwable $e) {
    echo "Erreur dans 2.2 : " . $e->getMessage();
}
$res = ob_get_clean();
$CreateCodeExemple('2.2', 'h3', $code, $res);

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
try {
    eval($code);
} catch (Throwable $e) {
    echo "Erreur dans 2.4 : " . $e->getMessage();
}
$res = ob_get_clean();
$CreateCodeExemple('2.4', 'h3', $code, $res);

// 2.5
$code = <<<PHP

\$imgArray = array();
\$url = "https://api.thecatapi.com/v1/images/search?size=med&mime_types=jpg&format=json&has_breeds=true&order=RANDOM&page=0&limit=1";

try {
    for (\$i = 0; \$i < 3; \$i++) {
        \$result = @file_get_contents(\$url); // Utilisation de @ pour éviter l'affichage des warnings
        if (\$result === false) {
            throw new Exception("Erreur lors de la récupération des données depuis l'API.");
        }

        \$result = json_decode(\$result, true);
        if (!isset(\$result[0]['url'])) {
            throw new Exception("Le format des données retournées est incorrect.");
        }

        \$imgArray[] = [
            'twitch.tv/el_vials',
            \$result[0]['url'],
            'Cat',
        ];
    }

    foreach (\$imgArray as \$img) {
        echo "<img src='" . htmlspecialchars(\$img[1]) . "' alt='" . htmlspecialchars(\$img[2]) . "'>";
    }
} catch (Exception \$e) {
    echo "Une erreur est survenue : " . \$e->getMessage();
}

PHP;

ob_start();
try {
    eval($code);
} catch (Throwable $e) {
    echo "Erreur dans 2.5 : " . $e->getMessage();
}
$res = ob_get_clean();
$CreateCodeExemple('2.5', 'h3', $code, $res);
