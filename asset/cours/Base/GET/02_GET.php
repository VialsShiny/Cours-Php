<!DOCTYPE html>
<html lang='EN-en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>GET Php</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='GET Php'>
</head>

<body>

<h1>Nos produits</h1>

<a href="02_page2.php?article=jean&couleur=bleu&prix=30">Jean Bleu</a>
<a href="02_page2.php?article=jean&couleur=rouge&prix=32">Jean Rouge</a>
<a href="02_page2.php?article=jean&couleur=bleu&prix=28">Jean Noir</a>

<!-- Après le "?" l'url ce transforme en Tableau, quaund on utilise la super globale "$_GET" -->

<br>

<?php
$prenom = "Thibault";
$nom = "VIVI";

echo "<a href=" . "03_profile.php?prenom=$prenom&nom=$nom" . "> Profil </a>";

echo '<br>';

if ($_GET['action'] === 'modifier') {
    echo '<strong>La page a bien été modifier</strong>';
    echo "<em> $prenom $nom </em>";
} else if ($_GET['action'] === 'effacer') {
    $prenom = "";
    $nom = "";
    echo '<strong>La page a bien été effacer</strong>';
} else {

}
?>


<!-- #Script -->

</body>

</html>