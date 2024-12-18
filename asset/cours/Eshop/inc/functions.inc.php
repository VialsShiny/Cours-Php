<?php

/*
 * Debug
 */

// Fonction d'affichage d'un print_r() [2ème paramètre = 1] et d'un var_dump() [2ème paramètre = 2] avec balise <pre>
function debug($param, int $exit = 2): void
{
    if ($exit === 1) {
        echo '<pre style="background-color: #d5ecd4; padding: 1vh 5vh;">';
        echo '<strong>print_r($param)</strong> <br>';
        print_r($param);
        echo '</pre>';
    } elseif ($exit === 2) {
        echo '<pre style="background-color: #ebd4cb; padding: 1vh 5vh;">';
        echo '<strong>var_dump($param)</strong> <br>';
        var_dump($param);
        echo '</pre>';
    }
}

/*
 * Fonctions membre avec les rôles
 */
// Si l'internantes est connecté -> Bool
function internantesEstConnecte(): bool
{
    return isset($_SESSION['membre']);
}

// Si l'internantes est admin
function internantesEstConnecteEtAdmin(): bool
{
    return internantesEstConnecte() && ($_SESSION['membre']['statut'] ?? 0) === 1;
}

/*
 * Fonctions de requête
 */
function executeRequete(string $requete, array $param = []): PDOStatement
{
    if (!empty($param)) {
        foreach ($param as $indice => $value) {
            $param[$indice] = htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
    }

    global $pdo; // permet d'accéder à $pdo défini dans l'espace global (hors de la fonction) et dans le fichier init.inc.php
    $res = $pdo->prepare($requete); // Préparation de la requête
    $res->execute($param); // exécute de la requête avec les paramètres sécurisés

    return $res;
}

/**
 * Gestion du panier
 */

function creationDuPanier()
{
    if (!isset($_SESSION['panier']) && empty($_SESSION['panier'])) {
        $_SESSION['panier'] = [
            'titre' => [],
            'id_produit' => [],
            'quantite' => [],
            'prix' => []
        ];
    }
}

function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix)
{
    creationDuPanier();

    // Recherche de la position du produit dans le panier pour l'éviter les doublons
    $position_produit = array_search($id_produit, $_SESSION['panier']['id_produit'], true);

    // Si le produit est déjà dans le panier, on ajoute la quantité
    if ($position_produit !== false) {
        $_SESSION['panier']['quantite'][$position_produit] += $quantite;
    } else {

        // Sinon on le met dans le panier
        $_SESSION['panier']['titre'][] = $titre;
        $_SESSION['panier']['id_produit'][] = $id_produit;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
    }
}

function montantTotal()
{
    $total = 0;
    for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
    }

    return round($total, 2);
}

function retirerProduitDuPanier($id_produit)
{
    // Vérifie si le panier contient des produits
    if (!empty($_SESSION['panier'])) {
        // Parcours les produits du panier
        for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) {
            if ($_SESSION['panier']['id_produit'][$i] == $id_produit) {
                // Supprime les informations du produit des tableaux de la session
                unset($_SESSION['panier']['id_produit'][$i]);
                unset($_SESSION['panier']['titre'][$i]);
                unset($_SESSION['panier']['quantite'][$i]);
                unset($_SESSION['panier']['prix'][$i]);

                // Réindexe les tableaux pour éviter des trous dans les indices
                $_SESSION['panier']['id_produit'] = array_values($_SESSION['panier']['id_produit']);
                $_SESSION['panier']['titre'] = array_values($_SESSION['panier']['titre']);
                $_SESSION['panier']['quantite'] = array_values($_SESSION['panier']['quantite']);
                $_SESSION['panier']['prix'] = array_values($_SESSION['panier']['prix']);

                break; // Quitte la boucle une fois le produit supprimé
            }
        }
    }
}