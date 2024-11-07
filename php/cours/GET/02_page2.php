<?php
function debugV($param) {
    echo '<pre style="background: black; color: white;">';
    var_dump($param);
    echo '</pre>';
}

debugV($_GET);

if (isset($_GET['article']) && isset($_GET['couleur']) && isset($_GET['prix'])) {
    echo '<h1> Détails du produits </h1>';
    echo '<p> Article : ' . $_GET['article'] . '</p>';
    echo '<p> Couleur : ' . $_GET['couleur'] . '</p>';
    echo '<p> Prix : ' . $_GET['prix'] . '</p>';
} else {
    echo '<strong> Erreur 404 </strong>';
}