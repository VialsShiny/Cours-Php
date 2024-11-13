<?php

/*
> [!IMPORTANT]
> Cette fonction doit être appelée au début de chaque page où vous souhaitez utiliser la variable \$_SESSION .
> Stocker des données dans une session : Les données peuvent être stockées dans un tableau associatif \$_SESSION .
> Accéder aux données de session : Les données stockées dans $_SESSION peuvent être récupérées sur n'importe quelle page après l'initialisation de la session .
> Détruire une session : Lorsque l'utilisateur se déconnecte ou quitte l'application, il est souvent nécessaire de détruire la session pour supprimer toutes les données .
*/

// démarrer la session
session_start();

// stocker des infos dans la session
$_SESSION['username'] = 'Vivi';
$_SESSION['password'] = 'abcd1234';
$_SESSION['email'] = 'vivi@abcd.com';

var_dump($_SESSION);
