<?php

/*
   Vous créez un tableau PHP contenant les pays suivants : France, Italie, Espagne, inconnu, Allemagne auxquels vous associez les valeurs Paris, Rome, Madrid, '?', Berlin.
   Vous parcourez ce tableau pour afficher la phrase "La capitale X se situe en Y" dans un paragraphe (où X remplace la capitale et Y le pays).
   Pour le pays "inconnu" vous afficherez "Ca n'existe pas !" à la place de la phrase précédente.
 */
/*
     1- Vous réalisez un formulaire "Votre devis de travaux" qui permet de saisir le montant des travaux de votre maison en HT et de choisir la date de construction de votre maison (bouton radio) : "plus de 5 ans" ou "5 ans ou moins". Ce formulaire permettra de calculer le montant TTC de vos travaux selon la période de construction de votre maison.
     2- Vous créez une fonction montantTTC qui calcule le montant TTC à partir du montant HT donné par l'internaute et selon la période de construction : le taux de TVA est de 10% pour plus de 5 ans, et de 20% pour 5 ans ou moins. La fonction retourne  "Le montant de vos travaux est de X euros TTC." où X est le montant TTC calculé. Vous affichez le résultat au-dessus du formulaire.
 */

// Exemple :

$tabPays = array(
    "France" => "Paris",
    "Italie" => "Rome",
    "Espagne" => "Madrid",
    "Inconnue" => "?",
    "Allemagne" => "Berlin",
);

foreach ($tabPays as $key => $value) {
    if ($key == "Inconnue") {
        echo "Ca n'existe pas !" . '<br>';
    } else {
        echo "La capitale $value se situe en $key <br>";
    }
}

// 1 --
echo '<hr>';

require '03_form-house.inc.php';

// 2 --
echo '<hr>';

require '03_calculatrice.inc.php';

// 3 --
echo '<hr>';

require '03_liens.inc.php';

// 4 --
echo '<hr>';

if (isset($_GET) || !empty($_GET)) {
    if (isset($_GET['dish'])) {
        $dish = $_GET['dish'];
        echo "Tu as sélectionné '$dish' <br>";
        echo "Changer de plat : " . '<a href="03_restaurant.php">ICI</a>';
    } else {
        echo "Tu n'as rien sélectionner !" . '<br>' . '<a href="03_restaurant.php">Sélectionner un plat :</a>';
    }
}

// 5 --
echo '<hr>';

include '03_form.inc.php';


