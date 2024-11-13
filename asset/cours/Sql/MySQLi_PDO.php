<?php

echo '<h1 style="background-color: darkgreen; color: white; padding: 10px;">MySQLi</h1>';
echo '<h2 style="background-color: mediumslateblue; color: white; padding: 10px;">1 - Connexion avec Mysqli</h2>';

$mysqli = new mysqli("localhost", "root", "root", "entreprise");
// sous MAC: $mysqli = new mysqli("localhost", "root", "root", "entreprise");

// on vérifie la connexion
echo '<pre>';
var_dump($mysqli);
echo '</pre>';
echo '<pre>';
var_dump(get_class_methods($mysqli));
echo '</pre>';


echo '<h2 style="background-color: mediumslateblue; color: white; padding: 10px;">2 - Erreur de REQUETE</h2>';

//$mysqli->query("azerty");


echo '<h2 style="background-color: mediumslateblue; color: white; padding: 10px;">3 - INSERT / UPDATE / DELETE</h2>';

//$mysqli->query("INSERT INTO employes (nom,prenom, salaire, sexe, service, date_embauche) VALUES ('Pixel','Merlin',10000,'f','croquettes', '2020-01-01')");

echo 'nb lignes affectée : ' . $mysqli->affected_rows . '<hr>';

echo '<h2 style="background-color: mediumslateblue; color: white; padding: 10px;">4 - SELECT pour une seule ligne de résultat</h2>';

$res = $mysqli->query("SELECT * FROM employes WHERE id_employes = 350");
var_dump($res);
$employes = $res->fetch_assoc();
var_dump($employes);

$res = $mysqli->query("SELECT * FROM employes");
echo 'Nombre de lignes : ' . $res->num_rows . '<hr>';

while ($employes = $res->fetch_assoc())
{
    echo '<div style="display: inline-block; width: 21%; margin: 1%; padding: 1%; background-color: darkslategray; color: white;">';
    echo 'Nom: ' . $employes['nom'] . '<br />';
    echo 'Prénom: ' . $employes['prenom'] . '<br />';
    echo 'Salaire: ' . $employes['salaire'] . '<br />';
    echo 'Service: ' . $employes['service'] . '<br />';
    echo 'Sexe: ' . $employes['sexe'] . '<br />';
    echo 'Date d\'embauche: ' . $employes['date_embauche'] . '<br />';
    echo '</div>';
}

echo '<h2 style="background-color: mediumslateblue; color: white; padding: 10px;">6 - SELECT pour une seule ligne de résultat avec FETCH_ALL()</h2>';

$res = $mysqli->query("SELECT * FROM employes");
$donnees = $res->fetch_all();
var_dump($donnees);

echo '<h2 style="background-color: mediumslateblue; color: white; padding: 10px;">7 - EXERCICE</h2>';

$all_bdd = $mysqli->query("SHOW DATABASES");

echo '<ul>';
while ($item = $all_bdd->fetch_assoc()) {
    echo '<li>' . $item['Database'] . '</li>';
}
echo '</ul>';

echo '<h2 style="background-color: mediumslateblue; color: white; padding: 10px;">8 - SELECT pour plusieurs lignes de résultat affichées dans un tableau html cree dynamiquement</h2>';

$resultat = mysqli_query($mysqli, "SELECT * FROM employes");

echo '<table style="border: 1px solid black;border-collapse: collapse;width: 100%;">';
echo "<tr>";
while ($colonne = $resultat->fetch_field()) {
    echo '<th style="background-color: darkslategray;color: white;padding: 10px;font-size: 18px">' . $colonne->name . '</th>';

}
echo "</tr>";
while ($employes = $resultat->fetch_assoc()) {
    echo '<tr>';
    foreach ($employes as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}
echo '</table>';