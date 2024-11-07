<?php
// OUVRIR UN FICHIER : fopen()

$manipule = fopen('text.txt', 'r');

/*
Modes d'ouverture courants :
'r' : Ouvre un fichier en lecture seule. Le pointeur est placé au début du fichier.
'w' : Ouvre un fichier en écriture seule. Si le fichier existe, il est vidé. Sinon, il est créé.
'a' : Ouvre un fichier en écriture seule. Si le fichier existe, le pointeur est placé à la fin du fichier. Sinon, il est créé.
'r+' : Ouvre un fichier en lecture et écriture. Le pointeur est placé au début du fichier.
'w+' : Ouvre un fichier en lecture et écriture. Le fichier est vidé s'il existe, sinon il est créé.
*/

// FERMER UN FICHIER : fclose()

fclose($manipule);

// LIRE UN FICHIER : fread() \ 1 ---

$manipule = fopen('text.txt', 'r');
// print_r(htmlspecialchars(fread($manipule, filesize('text.txt'))));

// fgets() \ 2 ---

$manipule = fopen('text.txt', 'r');
fgets($manipule);
while ($ligne = fgets($manipule) !== false) {
    echo $ligne . '<br>';
}

// file_get_contents() \ 3 ---

$contenu = file_get_contents('text.txt');
echo $contenu;

// ECRIRE DANS UN FICHIER
// fwrite() \ 1 ---

$contenu = fopen('text.txt', 'w');
fwrite($contenu, 'Caca !!!');
fclose($contenu);

// file_put_contents \ 2 ---

file_put_contents('text.txt', 'Verneuil !!!');


// Créer un fichier JSON : json_encode()

$data = [
    "nom" => "Pixel",
    "age" => 4,
    "ville" => "Paris",
    "hobbies" => ["croquettes", "dodo", "boule de poils"]
];

$json = json_encode($data, JSON_PRETTY_PRINT);

file_put_contents('data.json', $json);

// Lire JSON
$json_data = json_decode($json, true);

// convertir le JSON en array associatif PHP
// $data = json_decode($json_decode, true);

echo $data['nom'] . '<br>';
echo $data['age'] . '<br>';
echo $data['ville'] . '<br>';

// boucle sur les hobbies
foreach ($data['hobbies'] as $hobby) {
    echo $hobby . '<br>';
}

// MODIFIER UN JSON : 4  étapes
$json_data = file_get_contents('date.json');
$date = json_decode($json_data, true);

$date['age'] = 4.5; // changer l'age
// $data['hobbies'][] = 'calins' // ajouter un nouveau hobbies

$json_data = json_encode($date, JSON_PRETTY_PRINT);

file_put_contents('data.json', $json_data);

$json_data = file_get_contents('date.json');
$data = json_decode($json_data, true);
