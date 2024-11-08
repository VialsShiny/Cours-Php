<?php
// Exercice 2 :
$CreateTitle('Exercice 2 :', 'h2');

// 2.1
$CreateTitle('2.1', 'h4');

$code = <<<'EOD'
// Définition des tableaux
$tab1 = array();
for ($i = 1; $i <= 10; $i++) {
array_push($tab1, $i);
}

$tab2 = array();
for ($i = 10; $i <= 20; $i++) {
array_push($tab2, $i);
}



$tabF = array();
for ($i = 0; $i <= 9; $i++) {
array_push($tabF, $tab1[$i] + $tab2[$i]);
}

// Affichage du tableau résultat
debug($tabF);
EOD;
$CreateCodeZone($code);
debug($code);

// 2.2
$CreateTitle('2.2', 'h4');

$code = <<<'EOD'
// Génération d'un tableau de nombres aléatoires
$tabRandom = array();
for ($i = 0; $i <= 9; $i++) {
array_push($tabRandom, rand(1, 100));
}
sort($tabRandom);
$newTab = implode(' ; ', $tabRandom);

// Affichage du tableau trié
debug($newTab);
EOD;
$CreateCodeZone($code);
debug($code);

// 2.3
$CreateTitle('2.3', 'h4');

$code = <<<'EOD'
// Inclusion du fichier '01_tab.inc.php'
include '01_tab.inc.php';
EOD;
$CreateCodeZone($code);
debug($code);

// 2.4
$CreateTitle('2.4', 'h4');

$code = <<<'EOD'
// Définition des tableaux
$arr1 = array(6, 25, 35, 61);
$arr2 = array(12, 24, 46);
$result = 0;

foreach ($arr2 as $x) {
for ($i = 0; $i < count($arr1); $i++) {
$result += $x * $arr1[$i];  // Calcul des produits
}
}

// Affichage du résultat
echo $result;
EOD;
$CreateCodeZone($code);
debug($code);

// 2.5
$CreateTitle('2.5', 'h4');

$code = <<<'EOD'
// Tableau pour stocker les images
$imgArray = array();

// URL de l'API pour récupérer des images de chats
$url = "https://api.thecatapi.com/v1/images/search?size=med&mime_types=jpg&format=json&has_breeds=true&order=RANDOM&page=0&limit=1";
$imgArray = [];

for ($i = 0; $i < 3; $i++) { // Récupération de 3 images
$result = file_get_contents($url);
$result = json_decode($result, true);

if (isset($result[0]['url'])) {
$imgArray[] = [
'twitch.tv/el_vials',
$result[0]['url'],
'Cat',
];
}
}

// Affichage des images
foreach ($imgArray as $img) {
echo "<img src='" . $img[1] . "' alt='" . $img[2] . "'>";
}
EOD;
$CreateCodeZone($code);
debug($code);
