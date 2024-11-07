<?php

$CreateTitle('Affichage d\'un tableau associatif', 'h2');

// Définition du tableau associatif
$arrInfo = array(
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

// Affichage du code
$code = <<<'EOD'
<head>
    <style>
        table {
            border-collapse: collapse;
        }
        th,
        td {
            border: 1px solid #000;
            padding: 5px 10px;
        }
        td {
            width: 95px;
        }
    </style>
</head>
<table>
    <caption>
        PHP
    </caption>
    <tbody>
    <tr>
        <th scope="col">Clé</th>
        <th scope="col" colspan="2">Valeur</th>
    </tr>
    <?php
    foreach ($arrInfo as $key => $valeur) {
        echo '<tr>';
        echo "<th scope=\"row\" rowspan=\"5\">$key</th>";
        foreach ($valeur as $k => $v) {
            if ($k === "Clé") {
                echo '<td>' . $k . '</td>';
            }
            if ($v === "Valeur") {
                echo '<td>' . $v . '</td>';
            }
        }
        echo '</tr>';
        foreach ($valeur as $k => $v) {
            echo '<tr>';
            if ($k !== "Clé") {
                echo '<td>' . $k . '</td>';
            }
            if ($v !== "Valeur") {
                echo '<td>' . $v . '</td>';
            }
            echo '</tr>';
        }
    }
    ?>
    </tbody>
</table>
EOD;
$CreateCodeZone($code);

// Exécution du code PHP pour afficher le tableau
?>
<table>
    <caption>
        PHP
    </caption>
    <tbody>
    <tr>
        <th scope="col">Clé</th>
        <th scope="col" colspan="2">Valeur</th>
    </tr>
    <?php
    foreach ($arrInfo as $key => $valeur) {
        echo '<tr>';
        echo "<th scope=\"row\" rowspan=\"5\">$key</th>";
        foreach ($valeur as $k => $v) {
            if ($k === "Clé") {
                echo '<td>' . $k . '</td>';
            }
            if ($v === "Valeur") {
                echo '<td>' . $v . '</td>';
            }
        }
        echo '</tr>';
        foreach ($valeur as $k => $v) {
            echo '<tr>';
            if ($k !== "Clé") {
                echo '<td>' . $k . '</td>';
            }
            if ($v !== "Valeur") {
                echo '<td>' . $v . '</td>';
            }
            echo '</tr>';
        }
    }
    ?>
    </tbody>
</table>

<hr>
