<?php

// Exercice
/**
 * 1- créer une page "profil" avec un nom et un prénom
 * 2- y ajouter un lien "modifier mon profil", ce lien passe dans l'url à la page exercice.php elle-même 
 * que l'action demandée est la modification du compte
 * 3- si la modification est demandée, c'est-à-dire que vous avez reçu cette info en $_GET, vous 
 * affichez "Vous avez demandé la modification de votre profil !"
 */

function debugV($param)
{
  echo '<pre style="background: black; color: white;">';
  var_dump($param);
  echo '</pre>';
}

debugV($_GET);

echo '<a href="02_GET.php?action=modifier">Modifier</a>' . '<br>';
echo '<a href="02_GET.php?action=effacer">Effacer</a>';
